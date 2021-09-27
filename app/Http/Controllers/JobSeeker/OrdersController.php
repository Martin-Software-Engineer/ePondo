<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Orders as ResourceOrders;
use App\Models\Order;
use App\Models\OrderDecline;
use App\Models\InvoiceNumber;
use App\Models\User;
use App\Helpers\System;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use DataTables;
use Carbon\Carbon;

use App\Notifications\OrderAccepted as OrderAcceptedNotification;
use App\Notifications\OrderDeclined as OrderDeclinedNotification;
use App\Notifications\OrderCompleted as OrderCompletedNotification;
use App\Notifications\OrderInvoice as OrderInvoiceNotification;

use App\Helpers\GiveReward;
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
        $data['order'] = $order;
        $data['order_id'] = System::GenerateFormattedId('S', $order->id);

        return view('jobseeker.contents.service-orders-view',$data);
    }

    public function accept($id){
        $order = Order::find($id);
        $jobseeker = User::find($order->service->jobseeker->id);
        $jobseeker_id = $jobseeker->id;
        
        $backer = User::find($order->backer_id);
        $totalorders = Order::whereHas('service', function($q) use($jobseeker_id){
            $q->where('user_id', $jobseeker_id);
        })->where('status','>',1)->where('status','!=',3)->count(); //Counter for Reward Points

        $order->status = 2;
        $order->save();        

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
        $order = Order::find($id);
        $jobseeker = User::find($order->service->jobseeker->id);
        $jobseeker_id = $jobseeker->id;
        $backer = User::find($order->backer->id);

        $totalorders = Order::whereHas('service', function($q) use($jobseeker_id){
            $q->where('user_id', $jobseeker_id);
        })->where('status','>',4)->where('status','!=',8)->count(); //Counter for Reward Points

        $order->status = 5;
        $order->save();

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
            'order_id' => System::GenerateFormattedId('S', $order->id)
        ]));
        Mail::to($backer->email)->queue(new SendMail('emails.backer.order-invoice-mail', [
            'subject' => 'Service Order Invoice & Payment',
            'order_id' => System::GenerateFormattedId('S', $order->id)
        ]));

        return response()->json(['success' => true, 'msg' => 'Order Delivered, Wait for the Buyer to responsd']);
    }

    public function decline(Request $request){
        $order = Order::find($request->order_id);
        $order->status = 3;
        $order->save();

        $backer = User::find($order->backer->id);
        $jobseeker = User::find($order->service->jobseeker->id);

        $jobseeker->notify(new OrderDeclinedNotification($order));
        $backer->notify(new OrderDeclinedNotification($order));

        OrderDecline::create(['order_id' => $order->id, 'reason' => $request->reason]);

        Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-decline-mail', [
            'subject' => 'Service Order Declined',
            'order_id' => System::GenerateFormattedId('S', $order->id)
        ]));
        Mail::to($backer->email)->queue(new SendMail('emails.backer.order-decline-mail', [
            'subject' => 'Service Order Declined',
            'order_id' => System::GenerateFormattedId('S', $order->id)
        ]));

        return response()->json(['success' => true, 'msg' => 'Order Declined']);
    }
}
