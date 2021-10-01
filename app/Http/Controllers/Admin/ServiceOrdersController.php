<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Mail\SendMail;
use App\Helpers\System;
use App\Helpers\GiveReward;
use App\Models\OrderCancel;
use App\Models\OrderDetail;
use App\Models\OrderDecline;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\Orders as ResourceOrder;
use App\Notifications\OrderFinish as OrderFinishNotification;
use App\Notifications\OrderInvoice as OrderInvoiceNotification;
use App\Notifications\OrderPayment as OrderPaymentNotification;
use App\Notifications\OrderAccepted as OrderAcceptedNotification;
use App\Notifications\OrderDeclined as OrderDeclinedNotification;
use App\Notifications\OrderFeedback as OrderFeedbackNotification;
use App\Notifications\OrderCancelled as OrderCancelledNotification;
use App\Notifications\OrderCompleted as OrderCompletedNotification;

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
                break;
            case 2:
                //Status Order Accepted
                   
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
                Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-decline-mail', [
                    'subject' => 'Service Order Declined',
                    'order_id' => $order_no
                ]));
                Mail::to($backer->email)->queue(new SendMail('emails.backer.order-decline-mail', [
                    'subject' => 'Service Order Declined',
                    'order_id' => $order_no
                ]));
                break;
            case 4:
                //Status Ongoing
                break;
            case 5:
                //Status Submitted as Complete & Pending Payment

                $price = $order->service->price;
                $invoice = $order->invoice()->create([
                    'price' => $price,
                    'date_due' =>  Carbon::now()->addDays(7),
                    'transaction_fee' => ($price*.07),
                    'processing_fee' => ($price*.03),
                    'total' => $price+($price*.07)+($price*.03)
                ]);

                    //Reward Points
                    if($totalorders <= 0){ //first time
                        $reward = new GiveReward($jobseeker->id, 'submit_1st_service_order_delivered');
                        $reward->send();
                    }else{
                        $reward = new GiveReward($jobseeker->id, 'submitting_service_order_delivered');
                        $reward->send();
                    }

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
                break;
            case 6:
                //Status Payment Successful, Pending Feedback & Rating
                //Unable to proceed with backend Transactions Model

                $invoice_id = System::GenerateFormattedId('I', $order->invoice->id);
                $service_title = $order->service->title;
                $delivery_address = $order->details->delivery_address;
                $backer_name = $backer->information->firstname.' '.$backer->information->lastname;
                $render_date = $order->details->render_date;

                $jobseeker->notify(new OrderPaymentNotification($order, $order->invoice));
                $backer->notify(new OrderPaymentNotification($order, $order->invoice));
                Mail::to($backer->email)->queue(new SendMail('emails.backer.order-payment-mail', [
                    'subject' => 'Payment Successful',
                    'order_id' => $order_no,
                    'invoice_id' => $invoice_id,
                    'backer_name' => $backer_name,
                    'jobseeker_name' => $jobseeker->information->firstname.' '.$jobseeker->information->lastname,
                    'render_date' => $render_date,
                    'delivery_address' => $delivery_address,
                    'service_title' => $service_title,
                    'amount' => $order->service->price + $order->invoice->transaction_fee + $order->invoice->processing_fee,
                    'paid_at' => 'N/A. Verify with Admin or ePondo Support Team (epondo.co@gmail.com)'
                ]));
                Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-payment-mail', [
                    'subject' => 'Payment Successful',
                    'order_id' => $order_no,
                    'invoice_id' => $invoice_id,
                    'price' => $order->service->price,
                    'service_title' => $service_title,
                    'delivery_address' => $delivery_address,
                    'render_date' => $render_date,
                    'backer_name' => $backer_name
                ]));
                
                break;
            case 7:
                //Status Completed
                //Unable to process Feedbacks & Reward Points for Feedbacks

                $backer->notify(new OrderFinishNotification($order));
                $jobseeker->notify(new OrderFinishNotification($order));
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

                $jobseeker->notify(new OrderCancelledNotification($order));
                $backer->notify(new OrderCancelledNotification($order));
                Mail::to($backer->email)->queue(new SendMail('emails.order-cancel-request-mail', [
                    'subject' => 'Service Order Cancelled',
                    'order_id' => $order_no
                ]));
                Mail::to($jobseeker->email)->queue(new SendMail('emails.order-cancelled-mail', [
                    'subject' => 'Service Order Cancelled',
                    'order_id' => $order_no
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
