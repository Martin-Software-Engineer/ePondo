<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Http\Resources\PaymentMethod as PaymentMethodResource;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\WebProfile;
use PayPal\Api\InputFields;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;

use App\Models\Campaign;
use App\Models\Transaction as MyTransaction;

use Carbon\Carbon;
use App\Mail\SendMail;
class DonatePaymentsController extends Controller
{
    private $currency = 'USD';

    public function CreatePayPalPayment(Request $request){
        if(!User::where('id',$request->user_id)->exists()){
            die('User not recognized');
        }

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(env('PAYPAL_CLIENT_ID', ''),env('PAYPAL_CLIENT_SECRET',''))
        );
        
        if(env('PAYPAL_MODE') == 'production'){
            $apiContext->setConfig(array('mode' => 'live'));
        }
        
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
    
        $campaign = Campaign::find($request->campaign_id);
        $user = User::find($request->user_id);
        
        $item = new Item();
        $item->setName('Donation to '.$campaign->title)
            ->setCurrency($this->currency)
            ->setQuantity(1)
            ->setSku('') // Similar to `item_number` in Classic API
            ->setPrice($request->amount);
    
        $itemList = new ItemList();
        $itemList->setItems(array($item));
    
        $amount = new Amount();
        $amount->setCurrency($this->currency)
            ->setTotal($request->amount);
    
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber(uniqid());
    
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(route('payment.success'))
            ->setCancelUrl(route('payment.cancel'));
    
        // Add NO SHIPPING OPTION
        $inputFields = new InputFields();
        $inputFields->setNoShipping(1);
    
        $webProfile = new WebProfile();
        $webProfile->setName($user->username . uniqid())->setInputFields($inputFields);
    
        $webProfileId = $webProfile->create($apiContext)->getId();
    
        $payment = new Payment();
        $payment->setExperienceProfileId($webProfileId); // no shipping
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
    
        try {
            $payment->create($apiContext);
            $donation = Donation::create([
                'messages' => $request->message,
                'amount' => $request->amount
            ]);

            $user->donations()->attach($donation->id);

            $transaction = MyTransaction::create([
                'payment_id' => $payment->id,
                'payment_method' => $payment->payer->payment_method,
                'amount' => $payment->transactions[0]->amount->total,
                'currency' => $payment->transactions[0]->amount->currency,
                'status' => $payment->state
            ]);

            $campaign->donations()->attach($donation->id);
            $campaign->transactions()->attach($transaction->id);

            return $payment;
        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }
    }
    public function ExecutePayPalPayment(Request $request){
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(env('PAYPAL_CLIENT_ID', ''),env('PAYPAL_CLIENT_SECRET',''))
        );
    
        $paymentId = $request->paymentID;
        $payment = Payment::get($paymentId, $apiContext);
    
        $execution = new PaymentExecution();
        $execution->setPayerId($request->payerID);
    
        try {
            $result = $payment->execute($execution, $apiContext);

            if($payment->state == 'approved'){
                $transaction = MyTransaction::where('payment_id', $payment->id)->first();
                $transaction->status = $payment->state;
                $transaction->paid_at = Carbon::now()->toDateString();
                $transaction->save();
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }
    }

    public function CreateStripePayment(Request $request){
        if(!User::where('id',$request->user_id)->exists()){
            die('User not recognized');
        }

        $user = User::find($request->user_id);
        $campaign = Campaign::find($request->campaign_id);

        // This is a sample test API key. Sign in to see examples pre-filled with your key.
        $stripe_api_key = env('STRIPE_API_KEY', '');
        Stripe::setApiKey($stripe_api_key);

        $items = array([
            'currency' => $this->currency,
            'unit_amount' => $request->amount,
            'product_data' => [
                'name' => 'Donation to '.$campaign->title,
                'description' => '',
            ],
            'quantity' => 1
        ]);
    
        try {
            // retrieve JSON from POST body
            $paymentIntent = PaymentIntent::create([
              'amount' => $this->calculateOrderAmount($items),
              'currency' => $this->currency,
            ]);

            $donation = Donation::create([
                'messages' => $request->message,
                'amount' => $request->amount
            ]);

            $user->donations()->attach($donation->id);

            $transaction = MyTransaction::create([
                'payment_id' => $paymentIntent->id,
                'payment_method' => 'stripe_payment',
                'amount' => $paymentIntent->amount/100,
                'currency' => $paymentIntent->currency,
                'status' => $paymentIntent->status
            ]);

            $campaign->donations()->attach($donation->id);
            $campaign->transactions()->attach($transaction->id);

            return response()->json(['clientSecret' => $paymentIntent->client_secret]);

          } catch (Error $e) {
            http_response_code(500);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function ConfirmStripePayment(Request $request){
        $stripe_api_key = env('STRIPE_API_KEY', '');
        $stripe = new StripeClient($stripe_api_key);
        
        try {
            $result = $stripe->paymentIntents->retrieve(
                $request->id,
                []
            );

            if($result->status == 'succeeded'){
                $transaction = MyTransaction::where('payment_id', $result->id)->first();
                $transaction->status = $result->status;
                $transaction->paid_at = Carbon::now()->toDateString();
                $transaction->save();

                return response()->json(['success' => true]);
            }
           
        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }
    }
}
