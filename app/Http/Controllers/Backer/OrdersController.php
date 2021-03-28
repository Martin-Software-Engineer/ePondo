<?php

namespace App\Http\Controllers\Backer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BackerOrders as ResourceBackerOrders;
use App\Models\Order;
use App\Models\OrderCancel;
use App\Helpers\System;
use DataTables;
class OrdersController extends Controller
{
    public function index(){
        return view('backer.contents.orders');
    }

    public function data(){
        $orders = Order::whereHas('service')->whereHas('transactions', function($q){
            $q->where('status', 'approved');
        })->with(['service'])->where('backer_id', auth()->user()->id)->get();
        
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
