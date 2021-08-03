<?php

namespace App\Http\Controllers\Backer;

use DataTables;
use App\Models\Order;
use App\Helpers\System;
use App\Models\OrderCancel;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\BackerOrders as ResourceBackerOrders;

class OrdersController extends Controller
{
    public function index(){
        return view('backer.contents.orders');
    }

    public function data(){
        $orders = Order::whereHas('service')->with(['service'])->where('backer_id', auth()->user()->id)->get();
        
        return DataTables::of(ResourceBackerOrders::collection($orders))->toJson();
    }

    public function edit($id){
        $order = Order::where('id', $id)->with('service')->first();
        return new ResourceBackerOrders($order);
    }

    public function show($id){
        $order = Order::where(['id' => $id, 'backer_id' => auth()->user()->id])->with(['service', 'details', 'backer'])->first();
        $data['order'] = $order;
        $data['order_id'] = System::GenerateFormattedId('S', $order->id);

        //return $data;
        return view('backer.contents.orders-view',$data);
    }

    public function invoice($id){
        $order = Order::where(['id' => $id, 'backer_id' => auth()->user()->id])->with(['service', 'details', 'backer', 'invoice'])->first();

        $duration = '';
        $durationDec = $order->service->duration_hours + ($order->service->duration_minutes/60);
        if($order->service->duration_hours > 1){
            $duration = $order->service->duration_hours.' Hours';
        }else{
            $duration = $order->service->duration_hours.' Hour';
        }

        if($order->service->duration_minutes > 1){
            $duration = $duration.' '.$order->service->duration_minutes.' Minutes';
        }

        //return $data;
        $data = [
            'order_no' => System::GenerateFormattedId('S', $order->id),
            'order_id' => $order->id,
            'invoice_no' => $order->invoice->id,
            'invoice_no2' => 'I-000-00'.$order->invoice->id,
            'currency' => $order->service->currency,
            'date_issued' => $order->invoice->created_at,
            'date_due' => $order->invoice->date_due,
            'from' => (object)[
                'name' => $order->service->jobseeker->information->firstname.' '.$order->service->jobseeker->information->lastname,
                'email' => $order->service->jobseeker->email,
                'contact' => $order->service->jobseeker->information->phone,
                'address' => $order->service->jobseeker->information->address
            ],
            'to' => (object)[
                'name' => $order->backer->information->firstname.''.$order->backer->information->lastname,
                'email' => $order->backer->email,
                'contact' => $order->backer->information->phone,
                'address' => $order->backer->information->address
            ],
            'service' => (object)[
                'title' => $order->service->title,
                'description' => $order->service->description,
                'price' =>  $order->service->price,
                'duration' => $duration,
                'categories' => $order->service->categories,
            ],
            'delivery_address' => $order->details->delivery_address,
            'add_charges' => [],
            'transaction_fee' => $order->invoice->transaction_fee,
            'processing_fee' => $order->invoice->processing_fee,
            'total' => $order->service->price + $order->invoice->transaction_fee + $order->invoice->processing_fee  
        ];
        
        //return $data;
        return view('backer.contents.orders-invoice',$data);
    }

    public function create(){

    }

    public function cancel(Request $request){
        $order = Order::find($request->id);
        $order->status = 8;
        $order->save();

        if($order)
            OrderCancel::create(['order_id' => $request->id, 'reason' => $request->reason]);

        return response()->json(['success' => true, 'msg' => 'Order Cancelled.']);
    }
}
