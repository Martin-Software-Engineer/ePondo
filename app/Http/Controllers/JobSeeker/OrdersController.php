<?php

namespace App\Http\Controllers\JobSeeker;

use DataTables;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Mail\SendMail;
use App\Helpers\System;
use App\Models\Invoice;
use App\Helpers\GiveReward;
use App\Models\OrderCancel;
use App\Models\OrderDecline;
use Illuminate\Http\Request;
use App\Models\InvoiceNumber;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\Orders as ResourceOrders;
use App\Notifications\OrderInvoice as OrderInvoiceNotification;
use App\Notifications\OrderAccepted as OrderAcceptedNotification;

use App\Notifications\OrderDeclined as OrderDeclinedNotification;
use App\Notifications\OrderCompleted as OrderCompletedNotification;
use App\Notifications\OrderCompletedCOD as OrderCompletedCODNotification;
use App\Notifications\OrderCancelled as OrderCancelledNotification;

class OrdersController extends Controller
{
    public function index(){
        return view('jobseeker.contents.service-orders');
    }

    public function data(){
        $user_id = auth()->user()->id;
        $results = Order::whereHas('service', function($q) use($user_id){
            $q->where('user_id', $user_id);
        })->with(['backer', 'service'])->get();
        return DataTables::of(ResourceOrders::collection($results))->toJson();
    }

    public function show($id){
        $order = Order::where('id',$id)->with(['service', 'details', 'backer'])->first();
        if(!$order){
            abort(404, 'Page not found.');
        }

        if($order->service->jobseeker->id != auth()->user()->id)
            abort(403, 'Unauthorized action.');

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

        return view('jobseeker.contents.service-orders-view',$data);
    }

    public function accept($id){
        $order = Order::where('id',$id)->with('service')->first();
        
        if(!$order){
            abort(404, 'Page not found.');
        }

        if($order->service->jobseeker->id != auth()->user()->id)
            abort(403, 'Unauthorized action.');

        $jobseeker = User::find($order->service->jobseeker->id);
        $jobseeker_id = $jobseeker->id;
        
        $backer = User::find($order->backer_id);
        $totalorders = Order::whereHas('service', function($q) use($jobseeker_id){
            $q->where('user_id', $jobseeker_id);
        })->where('status','>',1)->where('status','!=',3)->count(); //Counter for Reward Points

        $order->status = 2;
        $order->save();
        
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
            $processing_fee = ($price * 0.039) + 15;
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
            $reward = new GiveReward(auth()->user()->id, 'accepting_1st_service_order_request');
            $reward->send();
        }else{
            $reward = new GiveReward(auth()->user()->id, 'accepting_service_order_request');
            $reward->send();
        }

        $jobseeker->notify(new OrderAcceptedNotification($order));
        $backer->notify(new OrderAcceptedNotification($order));

        Mail::to(auth()->user()->email)->queue(new SendMail('emails.jobseeker.order-accept-mail', [
            'subject' => 'Service Order Accepted',
            'order_id' => System::GenerateFormattedId('S', $order->id)
        ]));
        Mail::to($backer->email)->queue(new SendMail('emails.backer.order-accept-mail', [
            'subject' => 'Service Order Accepted',
            'order_id' => System::GenerateFormattedId('S', $order->id)
        ]));
        
        if($order)
            return response()->json(['success' => true, 'msg' => 'Order Accepted']);
    }

    public function deliver($id){
        $order = Order::where('id',$id)->with('service')->first();

        if(!$order){
            abort(404, 'Page not found.');
        }

        if($order->service->jobseeker->id != auth()->user()->id)
            abort(403, 'Unauthorized action.');


        $jobseeker = User::find($order->service->jobseeker->id);
        $jobseeker_id = $jobseeker->id;
        $backer = User::find($order->backer->id);
        $invoice = Invoice::where('order_id',$order->id)->first();
        $order_id = System::GenerateFormattedId('S', $order->id);
        
        $invoice_id = System::GenerateFormattedId('I', $order->invoice->id);
        $service_title = $order->service->title;
        $delivery_address = $order->details->delivery_address;
        $backer_name = $backer->information->firstname.' '.$backer->information->lastname;
        $render_date = $order->details->render_date;

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

            $invoice_id = System::GenerateFormattedId('I', $order->invoice->id);
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
                'order_id' => $order_id,
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
                'order_id' => $order_id,
                'invoice_id' => $invoice_id,
                'price' => $order->service->price,
                'service_title' => $service_title,
                'delivery_address' => $delivery_address,
                'render_date' => $render_date,
                'backer_name' => $backer->information->firstname.' '.$backer->information->lastname,
                'payment_method' => $order->details->payment_method
            ]));

            return response()->json(['success' => true, 'msg' => 'Successfully Delivered Order & Received Payment']);
        }
        elseif ($order->details->payment_method == 'OP')
        {
            $order->status = 5;
            $order->save();
            $invoice->status = 2;
            $invoice->save();

            $jobseeker->notify(new OrderCompletedNotification($order));
            $backer->notify(new OrderCompletedNotification($order));

            $jobseeker->notify(new OrderInvoiceNotification($order, $invoice));
            $backer->notify(new OrderInvoiceNotification($order, $invoice));

            Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-delivered-mail', [
                'subject' => 'Service Order Delivered',
                'order_id' => $order_id
            ]));
            Mail::to($backer->email)->queue(new SendMail('emails.backer.order-invoice-mail', [
                'subject' => 'Service Order Invoice & Payment',
                'order_id' => $order_id
            ]));

            return response()->json(['success' => true, 'msg' => 'Order Delivered, wait for the Buyer to Process Payment']);
        }

    }

    public function decline(Request $request){
        $request->validate(['reason' => 'required|string|max:500']);
        
        $order = Order::where('id',$request->order_id)->with('service')->first();

        if(!$order)
            abort(404, 'Page not found.');

        if($order->service->jobseeker->id != auth()->user()->id)
            abort(403, 'Unauthorized action.');

            
        $order->status = 3;
        $order->save();

        $backer = User::find($order->backer->id);
        $jobseeker = User::find($order->service->jobseeker->id);

        $jobseeker->notify(new OrderDeclinedNotification($order));
        $backer->notify(new OrderDeclinedNotification($order));

        $decline = OrderDecline::create(['order_id' => $order->id, 'reason' => $request->reason]);

        Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-decline-mail', [
            'subject' => 'Service Order Declined',
            'order_id' => System::GenerateFormattedId('S', $order->id),
            'reason' => $decline->reason
        ]));
        Mail::to($backer->email)->queue(new SendMail('emails.backer.order-decline-mail', [
            'subject' => 'Service Order Declined',
            'order_id' => System::GenerateFormattedId('S', $order->id),
            'reason' => $decline->reason
        ]));

        return response()->json(['success' => true, 'msg' => 'Order Declined']);
    }

    public function cancel(Request $request){

        $request->validate(['reason' => 'required|string|max:500']);
        
        $order = Order::where('id',$request->order_id)->with('service')->first();

        if(!$order)
            abort(404, 'Page not found.');

        if($order->service->jobseeker->id != auth()->user()->id)
            abort(403, 'Unauthorized action.');

        $orderDate = Carbon::parse($order->details->render_date);
        $now = Carbon::now();
        $datediff = $orderDate->diffInDays($now);

        if($datediff >= 3 && $orderDate > $now){
            
            if($order->status == 2){
                $invoice = Invoice::find($order->invoice->id);
                $invoice -> status = 4;
                $invoice ->save();
            }

            $order->status = 8;
            $order->save();
            
            $cancel = OrderCancel::create(['order_id' => $order->id, 'reason' => $request->reason, 'from' => $request->from]);

            $backer = User::find($order->backer->id);
            $jobseeker = User::find($order->service->jobseeker->id);

            $jobseeker->notify(new OrderCancelledNotification($order));
            $backer->notify(new OrderCancelledNotification($order));

            Mail::to($jobseeker->email)->queue(new SendMail('emails.order-cancel-request-mail', [
                'subject' => 'Service Order Cancelled',
                'order_id' => System::GenerateFormattedId('S', $order->id),
                'reason' => $cancel->reason
            ]));
            Mail::to($backer->email)->queue(new SendMail('emails.order-cancelled-mail', [
                'subject' => 'Service Order Cancelled',
                'order_id' => System::GenerateFormattedId('S', $order->id),
                'reason' => $cancel->reason
            ]));

            return response()->json(['success' => true, 'msg' => 'Order Cancelled.']); 
        }
        else
        {
            return response()->json(['success' => false, 'msg' => 'Cancel Order Not Permitted.']);
        }
        
    }
}
