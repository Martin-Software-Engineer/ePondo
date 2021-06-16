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

use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\StripeClient;

use App\Models\Donation;
use App\Models\Transaction as MyTransaction;
use App\Models\Campaign;
use App\Models\User;

use App\Notifications\DonateCampaign as DonateCampaignNotification;

use Carbon\Carbon;
use App\Mail\SendMail;
class DonatePaymentsController extends Controller
{
    private $currency = 'USD';

    public function CreatePayPalPayment(Request $request){
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(env('PAYPAL_CLIENT_ID'),env('PAYPAL_CLIENT_SECRET'))
        );

        if(env('PAYPAL_MODE') == 'production'){
            $apiContext->setConfig(array('mode' => 'live'));
        }
        
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        
        $donation = Donation::find($request->donation_id);

        $this->currency = $request->currency;
        
        $item = new Item();
        $item->setName('Donation to '.$donation->campaign->title)
            ->setCurrency($this->currency)
            ->setQuantity(1)
            ->setSku("Donate") // Similar to `item_number` in Classic API
            ->setPrice($donation->amount);
    
        $itemList = new ItemList();
        $itemList->setItems(array($item));
    
        $amount = new Amount();
        $amount->setCurrency($this->currency)
            ->setTotal($donation->amount);
    
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
        $webProfile->setName('test'.uniqid())->setInputFields($inputFields);
    
        $webProfileId = $webProfile->create($apiContext)->getId();
    
        $payment = new Payment();
        $payment->setExperienceProfileId($webProfileId); // no shipping
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
    
        try {    
            $payment->create($apiContext);
        } catch (PayPal\Exception\PayPalConnectionException $pce) {
            // Don't spit out errors or use "exit" like this in production code
            echo '<pre>';
            print_r(json_decode($pce->getData()));
            exit;
        }

        $transaction = MyTransaction::create([
            'payment_id' => $payment->id,
            'payment_method' => $payment->payer->payment_method,
            'amount' => $payment->transactions[0]->amount->total,
            'currency' => $payment->transactions[0]->amount->currency,
            'status' => $payment->state,
            'campaign_id' => $donation->campaign->id
        ]);

        $donation->transactions()->attach($transaction->id);

        return $payment;
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

                if($transaction->campaign_id != null){
                    $campaign = Campaign::find($transaction->campaign_id);
                    $jobseeker = User::find($campaign->jobseeker->id);
                    
                    if($transaction->backer_id != null){
                        $backer = User::find($transaction->backer_id);
                        $jobseeker->notify(new DonateCampaignNotification($backer, $campaign));
                    }else{
                        $jobseeker->notify(new DonateCampaignNotification(null, $campaign));
                    }
                }
            }
            return $result;
        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }
    }

    public function CreateStripePayment(Request $request){

        $donation = Donation::find($request->donation_id);
        $this->currency = $request->currency;

        // This is a sample test API key. Sign in to see examples pre-filled with your key.
        $stripe_api_key = env('STRIPE_API_KEY', '');
        Stripe::setApiKey($stripe_api_key);

        $items = array([
            'currency' => $this->currency,
            'unit_amount' => $donation->amount,
            'product_data' => [
                'name' => 'Donation to '.$donation->title,
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

            $transaction = MyTransaction::create([
                'payment_id' => $paymentIntent->id,
                'payment_method' => 'stripe',
                'amount' => $paymentIntent->amount/100,
                'currency' => $paymentIntent->currency,
                'status' => $paymentIntent->status,
                'campaign_id' => $donation->campaign->id
            ]);
    
            $donation->transactions()->attach($transaction->id);
    
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
                $transaction->status = 'approved';
                $transaction->paid_at = Carbon::now()->toDateString();
                $transaction->save();
                
                if($transaction->campaign_id != null){
                    $campaign = Campaign::find($transaction->campaign_id);
                    $jobseeker = User::find($campaign->jobseeker->id);
                    
                    if($transaction->backer_id != null){
                        $backer = User::find($transaction->backer_id);
                        $jobseeker->notify(new DonateCampaignNotification($backer, $campaign));
                    }else{
                        $jobseeker->notify(new DonateCampaignNotification(null, $campaign));
                    }
                }

                return response()->json(['success' => true]);
            }
           
        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }
    }

    function calculateOrderAmount(array $items) : int {
        // Replace this constant with a calculation of the order's amount
        // Calculate the order total on the server to prevent
        // customers from directly manipulating the amount on the client
        $amount = 0;
        foreach($items as $item){
            $amount += $item['unit_amount'];
        }
        return $amount * 100;
    }
}
