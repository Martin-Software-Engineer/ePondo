<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Mail\SendMail;
use App\Helpers\System;
use App\Models\Invoice;
use App\Models\Feedback;
use App\Helpers\GiveReward;
use App\Models\OrderCancel;
use App\Models\OrderDetail;
use App\Models\OrderDecline;

use Illuminate\Http\Request;
use App\Models\ServiceRating;
use App\Models\ServiceReward;
use App\Models\FeedbackPlatform;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\Transaction as MyTransaction;
use App\Http\Resources\Orders as ResourceOrder;
use App\Notifications\OrderFinish as OrderFinishNotification;
use App\Notifications\OrderInvoice as OrderInvoiceNotification;
use App\Notifications\OrderPayment as OrderPaymentNotification;
use App\Notifications\OrderAccepted as OrderAcceptedNotification;
use App\Notifications\OrderDeclined as OrderDeclinedNotification;
use App\Notifications\OrderFeedback as OrderFeedbackNotification;
use App\Notifications\OrderReceived as OrderReceivedNotification;
use App\Notifications\OrderCancelled as OrderCancelledNotification;
use App\Notifications\OrderCompleted as OrderCompletedNotification;
use App\Notifications\OrderCompletedCOD as OrderCompletedCODNotification;

class ServiceOrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Services Orders';
        
        return view('admin.contents.service-orders.index', $data);
    }

    /**
     * Show all records in json format.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(){
        $results = Order::whereHas('service')->with(['service','backer'])->get();
        
        return DataTables::of(ResourceOrder::collection($results))->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::where('id', $id)->with(['service', 'details', 'backer'])->first();

        if($order->status == 3)
        {
            $decline = OrderDecline::where('order_id', $order->id)->first();
            $data['decline'] = $decline;
        }
        elseif($order->status == 8)
        {
            $cancel = OrderCancel::where('order_id', $order->id)->first();
            $data['cancel'] = $cancel;
        }

        $data['title'] = 'View Service Order';
        $data['order'] = $order;
        $data['order_id'] = System::GenerateFormattedId('S', $order->id);

        return view('admin.contents.service-orders.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Service Order';
        $data['order'] = Order::where('id', $id)->with(['service', 'details', 'backer'])->first();
        $data['order_id'] = System::GenerateFormattedId('S', $data['order']->id);

        return view('admin.contents.service-orders.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $new_orderstatus = 0;
        $order = Order::where('id', $id)->first();
            if($order->status != $request->orderstatus){
                $order->status = $request->orderstatus;

                $jobseeker = User::find($order->service->jobseeker->id);
                $jobseeker_id = $jobseeker->id;
                $backer = User::find($order->backer_id);
                $totalorders = Order::whereHas('service', function($q) use($jobseeker_id){
                    $q->where('user_id', $jobseeker_id);
                    })->where('status','>',1)->where('status','!=',3)->count();             //Counter for Reward Points
  
                $order->save();
                $new_orderstatus = $order->status;
            }
            $order_no = System::GenerateFormattedId('S', $order->id);
        
            $details = OrderDetail::where('order_id',$id)->first();
            $details->render_date = $request->target_date;
            $details->delivery_address = $request->location;
            $details->payment_method = $request->payment_method;
            $details->message = $request->description;
            $details->save();
        
        switch ($new_orderstatus) {
            case 0:
                //Status Unchanged
                break;
            case 1:
                //Status Pending Request
                $jobseeker->notify(new OrderReceivedNotification($order));
                $backer->notify(new OrderReceivedNotification($order));
                
                Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-request-mail', [
                    'subject' => 'Service Order Request',
                    'customer_name' => $jobseeker->userinformation->firstname.' '.$jobseeker->userinformation->lastname,
                    'order_id' => $order_no,
                    'order_title' => $order->service->title,
                    'price' => number_format($order->service->price, 2),
                    'render_date' => date('F d, Y', strtotime($details->render_date)),
                    'delivery_address' => $details->delivery_address,
                    'payment_method' => $details->payment_method,
                    'message' => $details->message

                ]));
                Mail::to($backer->email)->queue(new SendMail('emails.backer.order-request-mail', [
                    'subject' => 'Service Order Request',
                    'jobseeker_name' => $jobseeker->userinformation->firstname.' '.$jobseeker->userinformation->lastname,
                    'order_id' => $order_no,
                    'order_title' => $order->service->title,
                    'price' => number_format($order->service->price, 2),
                    'render_date' => date('F d, Y', strtotime($details->render_date)),
                    'delivery_address' => $details->delivery_address,
                    'payment_method' => $details->payment_method,
                    'message' => $details->message

                ]));
                
                
                //Reward Points
                if($totalorders <= 0){ //first time
                    $reward = new GiveReward($jobseeker->id, 'receiving_1st_service_order_request');
                    $reward->send();
                }else{
                    $reward = new GiveReward($jobseeker->id, 'receiving_service_order_request');
                    $reward->send();
                }
                break;
            case 2:
                //Status Order Accepted
                   
                    //Transaction Fee
                    $price = $order->service->price;
                    $cpoints = $jobseeker->rewards->sum('points');
                    $tier = System::RewardsTier($cpoints);
                    $reward_earned = System::RewardsEarn($price, $tier);
                    $transaction_fee = $reward_earned;

                    //Create Invoice
                    if($order->details->payment_method == 'COD')
                    {
                        $date_due =  $order->details->render_date;
                        $processing_fee = 0;
                    }
                    else
                    {
                        $date_due =  Carbon::parse( $order->details->render_date)->addDays(3);
                        $processing_fee = ($price * 0.03);
                    }
                    $order->invoice()->create([
                        'price' => $price,
                        'date_due' => $date_due,
                        'transaction_fee' => $transaction_fee,
                        'processing_fee' => $processing_fee,
                        'add_charges' => 0,
                        'total' => $price + $transaction_fee + $processing_fee
                    ]);

                    //Reward Points
                    if($totalorders <= 0){ //first time
                        $reward = new GiveReward($jobseeker->id, 'accepting_1st_service_order_request');
                        $reward->send();
                    }else{
                        $reward = new GiveReward($jobseeker->id, 'accepting_service_order_request');
                        $reward->send();
                    }

                    $jobseeker->notify(new OrderAcceptedNotification($order));
                    $backer->notify(new OrderAcceptedNotification($order));

                    Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-accept-mail', [
                        'subject' => 'Service Order Accepted',
                        'order_id' => $order_no
                    ]));
                    Mail::to($backer->email)->queue(new SendMail('emails.backer.order-accept-mail', [
                        'subject' => 'Service Order Accepted',
                        'order_id' => $order_no
                    ]));

                break;
            case 3:
                //Status Declined

                $jobseeker->notify(new OrderDeclinedNotification($order));
                $backer->notify(new OrderDeclinedNotification($order));

                $reason = "Administratively Declined. Consult with ePondo support team at epondo.co@gmail.com. Thank you!";
                $decline = OrderDecline::create(['order_id' => $order->id, 'reason' => $reason]);

                Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-decline-mail', [
                    'subject' => 'Service Order Declined',
                    'order_id' => $order_no,
                    'reason' => $decline->reason
                ]));
                Mail::to($backer->email)->queue(new SendMail('emails.backer.order-decline-mail', [
                    'subject' => 'Service Order Declined',
                    'order_id' => $order_no,
                    'reason' => $decline->reason
                ]));
                break;
            case 4:
                //Status Ongoing
                break;
            case 5:
                //Status Submitted as Complete & Pending Payment

                $invoice = Invoice::where('order_id',$order->id)->first();
                $invoice_id = System::GenerateFormattedId('I', $order->invoice->id);

                $totalorders = Order::whereHas('service', function($q) use($jobseeker_id){
                    $q->where('user_id', $jobseeker_id);
                })->where('status','>',4)->where('status','!=',8)->count(); //Counter for Reward Points

                //Reward Points
                if($totalorders <= 0){ //first time
                    $reward = new GiveReward($jobseeker->id, 'submit_1st_service_order_delivered');
                    $reward->send();
                }else{
                    $reward = new GiveReward($jobseeker->id, 'submitting_service_order_delivered');
                    $reward->send();
                }

                if ($order->details->payment_method == 'COD')
                {
                    $order->status = 6;
                    $order->save();
                    $invoice->status = 3;
                    $invoice->save();

                    $service_title = $order->service->title;
                    $delivery_address = $order->details->delivery_address;
                    $backer_name = $backer->information->firstname.' '.$backer->information->lastname;
                    $jobseeker_name = $jobseeker->information->firstname.' '.$jobseeker->information->lastname;
                    $render_date = $order->details->render_date;
                    $paid_at = Carbon::now()->toDateString();

                    $jobseeker->notify(new OrderCompletedCODNotification($order));
                    $backer->notify(new OrderCompletedCODNotification($order));

                    Mail::to($backer->email)->queue(new SendMail('emails.backer.order-completeCOD-mail', [
                        'subject' => 'Service Order Delivered & Payment Received',
                        'order_id' => $order_no,
                        'invoice_id' => $invoice_id,
                        'backer_name' => $backer_name,
                        'jobseeker_name' => $jobseeker_name,
                        'render_date' => $render_date,
                        'delivery_address' => $delivery_address,
                        'service_title' => $service_title,
                        'amount' => $invoice->total,
                        'paid_at' => $paid_at,
                        'payment_method' => $order->details->payment_method
                    ]));
                    Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-completeCOD-mail', [
                        'subject' => 'Service Order Delivered & Payment Received',
                        'order_id' => $order_no,
                        'invoice_id' => $invoice_id,
                        'price' => $order->service->price,
                        'service_title' => $service_title,
                        'delivery_address' => $delivery_address,
                        'render_date' => $render_date,
                        'backer_name' => $backer_name,
                        'payment_method' => $order->details->payment_method
                    ]));

                }
                elseif ($order->details->payment_method == 'OP')
                {
                    $invoice->status = 2;
                    $invoice->save();

                    $jobseeker->notify(new OrderCompletedNotification($order));
                    $backer->notify(new OrderCompletedNotification($order));

                    $jobseeker->notify(new OrderInvoiceNotification($order, $invoice));
                    $backer->notify(new OrderInvoiceNotification($order, $invoice));

                    Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-delivered-mail', [
                        'subject' => 'Service Order Delivered',
                        'order_id' => $order_no
                    ]));
                    Mail::to($backer->email)->queue(new SendMail('emails.backer.order-invoice-mail', [
                        'subject' => 'Service Order Invoice & Payment',
                        'order_id' => $order_no
                    ]));

                }

                break;
            case 6:
                //Status Payment Successful, Pending Feedback & Rating
                //for OP

                if($order->details->payment_method == 'OP'){

                        $invoice = Invoice::where('order_id',$order->id)->first();
                        $invoice->status = 3; //Paid
                        $invoice->save();

                        $transaction = MyTransaction::create([
                            'payment_id' => 'Admin',
                            'payment_method' => 'Admin',
                            'amount' => $invoice->total,
                            'currency' => 'PHP',
                            'status' => 'approved',
                            'paid_at' => Carbon::now()->toDateString()
                        ]);
            
                        $order->transactions()->attach($transaction->id);

                        $invoice_id = System::GenerateFormattedId('I', $invoice->id);
                        $service_title = $order->service->title;
                        $delivery_address = $order->details->delivery_address;
                        $backer_name = $backer->information->firstname.' '.$backer->information->lastname;
                        $render_date = $order->details->render_date;

                        $jobseeker->notify(new OrderPaymentNotification($order, $invoice));
                        $backer->notify(new OrderPaymentNotification($order, $invoice));

                        //Calculate Rewards Earned for Jobseeker Earnings 
                        $cpoints = $jobseeker->rewards->sum('points');
                        $tier = System::RewardsTier($cpoints);
                        $reward_earned = System::RewardsEarn($order->service->price, $tier);
                        ServiceReward::create(['user_id' => $jobseeker_id, 'order_id' => $order->id, 'amount' => $reward_earned]);

                        Mail::to($backer->email)->queue(new SendMail('emails.backer.order-payment-mail', [
                            'subject' => 'Payment Successful',
                            'order_id' => $order_no,
                            'invoice_id' => $invoice_id,
                            'backer_name' => $backer_name,
                            'jobseeker_name' => $jobseeker->information->firstname.' '.$jobseeker->information->lastname,
                            'render_date' => $render_date,
                            'delivery_address' => $delivery_address,
                            'service_title' => $service_title,
                            'amount' => $transaction->amount,
                            'paid_at' => $transaction->paid_at,
                            'payment_method' => $order->details->payment_method
                        ]));

                        Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-payment-mail', [
                            'subject' => 'Payment Successful',
                            'order_id' => $order_no,
                            'invoice_id' => $invoice_id,
                            'price' => $order->service->price,
                            'service_title' => $service_title,
                            'delivery_address' => $delivery_address,
                            'render_date' => $render_date,
                            'backer_name' => $backer_name,
                            'payment_method' => $order->details->payment_method
                        ]));

                }
                
                break;
            case 7:
                //Status Completed
                //Unable to process Feedbacks & Reward Points for Feedbacks

                // JOBSEEKER-----------------------------------------------------------------------------------
                
                
                $jrating = $order->ratings()->create([
                    'service_id' => $order->service->id,
                    'rating' => '5',
                    'feedback' => 'N/A Admin',
                    'from' => 'jobseeker'
                ]);
        
                Feedback::create([
                    'service_id' => $order->service->id,
                    'message' => 'N/A Admin',
                    'from' => 'jobseeker'
                ]);
        
                FeedbackPlatform::create([
                    'service_id' => $order->service->id,
                    'rating' => '5',
                    'message' => 'N/A Admin',
                    'from' => 'jobseeker',
                    'service_rating_id' => $jrating->id
                ]);
                
                $jobseeker->notify(new OrderFeedbackNotification($order));
        
                Mail::to($jobseeker->email)->queue(new SendMail('emails.order-feedback-mail', [
                    'subject' => 'Successful Service Order Feedback',
                    'order_id' => $order_no
                ]));

                // BACKER-----------------------------------------------------------------------------------

                $brating = $order->ratings()->create([
                    'service_id' => $order->service->id,
                    'rating' => '5',
                    'feedback' => 'N/A Admin',
                    'from' => 'backer'
                ]);
                
                Feedback::create([
                    'service_id' => $order->service->id,
                    'message' => 'N/A Admin',
                    'from' => 'backer'
                ]);
        
                FeedbackPlatform::create([
                    'service_id' => $order->service->id,
                    'rating' => '5',
                    'message' => 'N/A Admin',
                    'from' => 'backer',
                    'service_rating_id' => $brating->id
                ]);

                $backer->notify(new OrderFeedbackNotification($order));

                Mail::to($backer->email)->queue(new SendMail('emails.order-feedback-mail', [
                    'subject' => 'Successful Service Order Feedback',
                    'order_id' => $order_no
                ]));
        
                //Change SO status to Complete, both Jobseeker & Backer have Feedback & Reward Points
                    
                    $totalorders = Order::whereHas('service', function($q) use($jobseeker){
                        $q->where('user_id', $jobseeker->id);
                    })->where('status',7)->count(); //Counter for Reward Points
            
                    //Reward Points
                    if($totalorders <= 0){ //first time
                        $reward = new GiveReward($jobseeker->id, 'receiving_1st_service_order_rf');
                        $reward->send();
                        $reward2 = new GiveReward($jobseeker->id, 'creating_1st_service_order_feedback');
                        $reward2->send();
                    }
                    else{
                        $reward = new GiveReward($jobseeker->id, 'receiving_service_order_rf');
                        $reward->send();
                        $reward2 = new GiveReward($jobseeker->id, 'creating_service_order_feedback');
                        $reward2->send();
                    }
        
                    $jobseeker->notify(new OrderFinishNotification($order));
                    $backer->notify(new OrderFinishNotification($order));
        
                    Mail::to($backer->email)->queue(new SendMail('emails.backer.order-complete-mail', [
                        'subject' => 'Congratulations Service Order Complete!',
                        'order_id' => $order_no
                    ]));
                    Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-complete-mail', [
                        'subject' => 'Congratulations Service Order Complete!',
                        'order_id' => $order_no
                    ]));
        

                break;
            case 8:
                //Status Cancelled
                //Unable to process OrderCancel Model
                
                $cancel = OrderCancel::create([
                    'order_id' => $order->id, 
                    'reason' => 'Administratively Cancelled. Consult with ePondo support team at epondo.co@gmail.com. Thank you!', 
                    'from' =>'Admin'
                ]);

                $jobseeker->notify(new OrderCancelledNotification($order));
                $backer->notify(new OrderCancelledNotification($order));

                Mail::to($backer->email)->queue(new SendMail('emails.order-cancel-request-mail', [
                    'subject' => 'Service Order Cancelled',
                    'order_id' => $order_no,
                    'reason' => $cancel->reason
                ]));
                Mail::to($jobseeker->email)->queue(new SendMail('emails.order-cancelled-mail', [
                    'subject' => 'Service Order Cancelled',
                    'order_id' => $order_no,
                    'reason' => $cancel->reason
                ]));

                break;
        }
            
            return response()->json(['success' => true,'msg' => trans('Successfully Edited Service Order')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
