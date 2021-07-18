<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Order;
use App\Helpers\System;
use App\Http\Resources\Invoice  as ResourceInvoice;
use DataTables;
class InvoicesController extends Controller
{
    //
    public function index()
    {
        return view('jobseeker.contents.invoices');
    }

    public function data(){
        $user_id = auth()->user()->id;
        $results = Invoice::whereHas('order', function($q) use($user_id){
            $q->whereHas('service', function($q2) use($user_id){
                $q2->where('user_id', $user_id);
            });
        })->with('order')->get();

        return DataTables::of(ResourceInvoice::collection($results))->toJson();
    }

    public function show($id){
        $order = Order::whereHas('invoice', function($q) use ($id){
            $q->where('id', $id);
        })->with(['service', 'details', 'backer', 'invoice'])->first();

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
            'currency' => $order->service->currency,
            'date_period' => $order->invoice->date_due,
            'from' => (object)[
                'name' => $order->service->jobseeker->information->firstname.' '.$order->service->jobseeker->information->lastname,
                'address' => $order->service->jobseeker->information->address
            ],
            'to' => (object)[
                'name' => $order->backer->username,
                'address' => $order->backer->address
            ],
            'service' => (object)[
                'title' => $order->service->title,
                'price' => $order->service->price,
                'duration' => $duration,
                'subtotal' => $order->service->price
            ],
            'add_charges' => [],
            'transaction_fee' => $order->invoice->transaction_fee,
            'processing_fee' => $order->invoice->processing_fee,
            'earned' => $order->invoice->price,
            'total' => ($order->invoice->price) + $order->invoice->transaction_fee + $order->invoice->processing_fee
        ];
        
        //return $data;
        return view('jobseeker.contents.service-orders-invoice',$data);
    }
}
