<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
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

use App\Models\User;
use App\Models\Service;
use App\Models\Order;
use App\Models\Transaction as MyTransaction;
use App\Models\Donation;
use App\Models\Invoice;
use App\Models\ServiceReward;

use Carbon\Carbon;
use App\Mail\SendMail;
use App\Helpers\System;
use App\Notifications\OrderPayment as OrderPaymentNotification;
class OrderPaymentsController extends Controller
{
    private $currency = 'USD';

    public function CreatePayPalPayment(Request $request){
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(env('PAYPAL_CLIENT_ID', ''),env('PAYPAL_CLIENT_SECRET',''))
        );
        
        if(env('PAYPAL_MODE') == 'production'){
            $apiContext->setConfig(array('mode' => 'live'));
        }

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        
        

        $order = Order::with(['service', 'invoice'])->where('id',$request->order_id)->first();
        $invoice = $order->invoice;

        $this->currency = strtoupper($request->currency);

        $item = new Item();
        $item->setName($order->service->title)
            ->setCurrency($this->currency)
            ->setQuantity(1)
            ->setSku('Service Purchase Order') // Similar to `item_number` in Classic API
            ->setPrice($invoice->total);
    
        $itemList = new ItemList();
        $itemList->setItems(array($item));
    
        $amount = new Amount();
        $amount->setCurrency($this->currency)
            ->setTotal($invoice->total);
    
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
        $webProfile->setName($order->backer->username . uniqid())->setInputFields($inputFields);
    
        $webProfileId = $webProfile->create($apiContext)->getId();
    
        $payment = new Payment();
        $payment->setExperienceProfileId($webProfileId); // no shipping
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        
        try {
            $payment->create($apiContext);

            $transaction = MyTransaction::create([
                'payment_id' => $payment->id,
                'payment_method' => $payment->payer->payment_method,
                'amount' => $payment->transactions[0]->amount->total,
                'currency' => $payment->transactions[0]->amount->currency,
                'status' => $payment->state
            ]);

            $order->transactions()->attach($transaction->id);

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
                $transaction = MyTransaction::with('orders')->where('payment_id', $payment->id)->first();
                $transaction->status = $payment->state;
                $transaction->paid_at = Carbon::now()->toDateString();
                $transaction->save();

                $order = Order::find($transaction->orders[0]->id);

                $order->status = 6; //Payment Successcul & Pending Feedback Rating
                $order->save();
                $invoice = Invoice::where('order_id',$order->id);
                $invoice->status = 3; //Paid
                $invoice->save();

                $jobseeker_id = $order->service->jobseeker->id;
                $jobseeker = User::find($jobseeker_id);

                $backer_id = $order->backer->id; //Find Backer ID
                $backer = User::find($backer_id); //Get backer data for Email
                
                $order_id = System::GenerateFormattedId('S', $order->id);
                $invoice_id = System::GenerateFormattedId('I', $order->invoice->id);
                $service_title = $order->service->title;
                $delivery_address = $order->details->delivery_address;
                $backer_name = $backer->information->firstname.' '.$backer->information->lastname;
                $render_date = $order->details->render_date;

                $jobseeker->notify(new OrderPaymentNotification($order, $order->invoice));
                $backer->notify(new OrderPaymentNotification($order, $order->invoice));

                $cpoints = $jobseeker->rewards->sum('points');
                $tier = System::RewardsTier($cpoints);
                $reward_earned = System::RewardsEarn($order->service->price, $tier);
                ServiceReward::create(['user_id' => $jobseeker_id, 'order_id' => $order->id, 'amount' => $reward_earned]);

                Mail::to($backer->email)->queue(new SendMail('emails.backer.order-payment-mail', [
                    'subject' => 'Payment Successful',
                    'order_id' => $order_id,
                    'invoice_id' => $invoice_id,
                    'backer_name' => $backer_name,
                    'jobseeker_name' => $jobseeker->information->firstname.' '.$jobseeker->information->lastname,
                    'render_date' => $render_date,
                    'delivery_address' => $delivery_address,
                    'service_title' => $service_title,
                    'amount' => $transaction->amount,
                    'paid_at' => $transaction->paid_at
                ]));

                Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-payment-mail', [
                    'subject' => 'Payment Successful',
                    'order_id' => $order_id,
                    'invoice_id' => $invoice_id,
                    'price' => $order->service->price,
                    'service_title' => $service_title,
                    'delivery_address' => $delivery_address,
                    'render_date' => $render_date,
                    'backer_name' => $backer_name
                ]));
                
            }
            else //Added for unsuccessful payments
            {
                $transaction = MyTransaction::with('orders')->where('payment_id', $payment->id)->first();
                $order = Order::find($transaction->orders[0]->id);
                $order_id = System::GenerateFormattedId('S', $order->id);
                
                Mail::to($backer->email)->queue(new SendMail('emails.backer.order-paymentunsuccessful-mail', [
                    'subject' => 'Payment Unsuccessful',
                    'order_id' => $order_id,
                ]));
            }

            return $result;
        } catch (Exception $ex) {
            echo $ex;
            exit(1);
        }
    }

    public function CreateStripePayment(Request $request){

        $order = Order::with(['service', 'invoice'])->where('id',$request->order_id)->first();
        $invoice = $order->invoice;

        $this->currency = $request->currency;

        // This is a sample test API key. Sign in to see examples pre-filled with your key.
        $stripe_api_key = env('STRIPE_API_KEY', '');
        Stripe::setApiKey($stripe_api_key);

        $items = array([
            'currency' => $this->currency,
            'unit_amount' => $invoice->total,
            'product_data' => [
                'name' => 'Donation to '.$order->service->title,
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
                'status' => $paymentIntent->status
            ]);

            $order->transactions()->attach($transaction->id);

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

                $order = Order::find($transaction->orders[0]->id);
                $order->status = 6; //ongoing
                $order->save();
                
                $jobseeker = $order->service->user();
                $jobseeker->notify(new OrderPaymentNotification($order, $order->invoice));

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
