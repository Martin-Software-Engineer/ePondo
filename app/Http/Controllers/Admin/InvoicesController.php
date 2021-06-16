<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Invoice as ResourceInvoice;
use App\Models\Invoice;
use App\Helpers\System;
use App\Models\Order;
use DataTables;
class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Invoices';
        return view('admin.contents.invoices.index', $data);
    }

    /**
     * Show all records in json format.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(){
        $results = Invoice::with('order')->get();
        return DataTables::of(ResourceInvoice::collection($results))->toJson();
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
    public function show($id){
        $order = Order::where(['id' => $id])->with(['service', 'details', 'backer', 'invoice'])->first();

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
                'subtotal' => $order->service->price * $durationDec
            ],
            'add_charges' => [],
            'transaction_fee' => $order->invoice->transaction_fee,
            'processing_fee' => $order->invoice->processing_fee,
            'total' => ($order->service->price * $durationDec) + $order->invoice->transaction_fee + $order->invoice->processing_fee
        ];
        
        //return $data;
        return view('admin.contents.invoices.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
