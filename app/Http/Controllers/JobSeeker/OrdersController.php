<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Orders as ResourceOrders;
use App\Models\Order;
use App\Helpers\System;
use DataTables;
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
        $order->status = 4;
        $order->save();

        Mail::to(auth()->user()->email)->queue(new SendMail('emails.order-accept-email', [
            'subject' => 'Service Order Status',
            'order_id' => System::GenerateFormattedId('S', $order->id)
        ]));

        return response()->json(['success' => true, 'msg' => 'Order Accepted']);
    }

    public function decline($id){
        $order = Order::find($id);
        $order->status = 3;
        $order->save();

        return response()->json(['success' => true, 'msg' => 'Order Declined']);
    }
}
