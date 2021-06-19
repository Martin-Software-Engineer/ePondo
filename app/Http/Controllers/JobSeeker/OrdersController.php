<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Orders as ResourceOrders;
use App\Models\Order;
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

        //return $data;
        return view('jobseeker.contents.service-orders-view',$data);
    }

    public function accept($id){
        $order = Order::find($id);
        $order->status = 2;
        $order->save();

        $jobseeker_id = $order->service->jobseeker->id;
        $totalorders = Order::whereHas('service', function($q) use($jobseeker_id){
            $q->where('user_id', $jobseeker_id);
        })->count();
        if($totalorders <= 0){ //first time
            $reward = new GiveReward(auth()->user()->id, 'accepting_1st_service_order_request');
            $reward->send();
        }else{
            $reward = new GiveReward(auth()->user()->id, 'accepting_service_order_request');
            $reward->send();
        }

        auth()->user()->notify(new OrderAcceptedNotification($order));

        $backer = User::find($order->backer_id);
        $backer->notify(new OrderAcceptedNotification($order));
        
        if($order)
            return response()->json(['success' => true, 'msg' => 'Order Accepted']);
    }

    public function deliver($id){
        $order = Order::find($id);
        $order->status = 5;
        $order->save();

        $duration = $order->service->duration_hours+($order->service->duration_minutes/60);
        $price = $order->service->price*$duration;
        $invoice = $order->invoice()->create([
            'price' => $price,
            'date_due' =>  Carbon::now()->addDays(7),
            'transaction_fee' => ($price*.07),
            'processing_fee' => ($price*.03),
            'total' => $price+($price*.07)+($price*.03)
        ]);

        $jobseeker_id = $order->service->jobseeker->id;
        $totalorders = Order::whereHas('service', function($q) use($jobseeker_id){
            $q->where('user_id', $jobseeker_id);
        })->count();

        if($totalorders <= 0){ //first time
            $reward = new GiveReward(auth()->user()->id, 'submit_1st_service_order_delivered');
            $reward->send();
        }else{
            $reward = new GiveReward(auth()->user()->id, 'submitting_service_order_delivered');
            $reward->send();
        }

        auth()->user()->notify(new OrderCompletedNotification($order));
        auth()->user()->notify(new OrderInvoiceNotification($order, $invoice));
        return response()->json(['success' => true, 'msg' => 'Order Delivered, Wait for the Buyer to response']);
    }

    public function decline($id){
        $order = Order::find($id);
        $order->status = 3;
        $order->save();

        auth()->user()->notify(new OrderDeclinedNotification($order));

        return response()->json(['success' => true, 'msg' => 'Order Declined']);
    }
}
