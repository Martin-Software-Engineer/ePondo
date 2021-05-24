<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Orders as ResourceOrders;
use App\Models\Order;
use App\Models\InvoiceNumber;
use App\Helpers\System;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use DataTables;
use Carbon\Carbon;
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

        if($order)
        return response()->json(['success' => true, 'msg' => 'Order Accepted']);


    }

    public function deliver($id){
        $order = Order::find($id);
        $order->status = 5;
        $order->save();

        $price = $order->service->price*$order->service->duration;
        $order->invoice()->create([
            'price' => $price,
            'date_due' =>  Carbon::now()->addDays(7),
            'transaction_fee' => ($price*.07),
            'processing_fee' => ($price*.03),
            'total' => $price+($price*.07)+($price*.03)
        ]);

        return response()->json(['success' => true, 'msg' => 'Order Delivered, Wait for the Buyer to response']);
    }

    public function decline($id){
        $order = Order::find($id);
        $order->status = 3;
        $order->save();

        return response()->json(['success' => true, 'msg' => 'Order Declined']);
    }
}
