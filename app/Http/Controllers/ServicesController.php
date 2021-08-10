<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Service;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Helpers\System;
use App\Models\User;
use App\Mail\SendMail;
use App\Notifications\OrderReceived as OrderReceivedNotification;

use App\Helpers\GiveReward;
class ServicesController extends Controller
{
    public function __constructor(){
        $this->midlleware('auth');
    }
    public function avail(Request $request){
        $service = Service::find($request->service_id);
        $backer_id = auth()->user()->id;

        $order = Order::create([
            'backer_id' => $backer_id,
            'service_id' => $service->id
        ]);

        $details = OrderDetail::create([
            'order_id' => $order->id,
            'render_date' => $request->render_date,
            'delivery_address' => $request->delivery_address,
            'message' => $request->message
        ]);

        $jobseeker = User::find($service->user_id);
        $jobseeker->notify(new OrderReceivedNotification($order));
        Mail::to($jobseeker->email)->queue(new SendMail('emails.order-request-mail', [
            'subject' => 'Service Order Request',
            'customer_name' => auth()->user()->userinformation->firstname.' '.auth()->user()->userinformation->lastname,
            'order_id' => System::GenerateFormattedId('S', $order->id),
            'order_title' => $service->title,
            'price' => number_format($service->price, 2),
            'render_date' => date('F d, Y', strtotime($details->render_date)),
            'delivery_address' => $details->delivery_address,
            'message' => $details->message

        ]));
        
        $totalorders = Order::whereHas('service', function($q) use($jobseeker){
            $q->where('user_id', $jobseeker->id);
        })->count();
        if($totalorders <= 0){ //first time
            $reward = new GiveReward($jobseeker->id, 'receiving_1st_service_order_request');
            $reward->send();
        }else{
            $reward = new GiveReward($jobseeker->id, 'receiving_service_order_request');
            $reward->send();
        }

        return response()->json(array(
                'success' => true, 
                'msg' => 'Your order was successful submitted, Please wait for the confirmation from the JobSeeker!'          
            )
        );
    }
}
