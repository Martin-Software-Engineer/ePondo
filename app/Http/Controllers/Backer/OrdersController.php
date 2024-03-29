<?php

namespace App\Http\Controllers\Backer;

use DataTables;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Mail\SendMail;
use App\Helpers\System;
use App\Models\Invoice;
use App\Models\OrderCancel;
use App\Models\OrderDecline;
use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\Http\Resources\BackerOrders as ResourceBackerOrders;
use App\Notifications\OrderCancelled as OrderCancelledNotification;

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
        $order = Order::where('id', $id)->with(['service', 'backer'])->first();

        // if($campaign->user_id != auth()->user()->id)
        //     abort(403, 'Unauthorized action.');


        return new ResourceBackerOrders($order);
    }

    public function show($id){
        $order = Order::where(['id' => $id, 'backer_id' => auth()->user()->id])->with(['service', 'details', 'backer'])->first();
        
        if(!$order)
            abort(404, 'Page not found.');

        if($order->backer->id != auth()->user()->id)
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

        $data = [
            'order_no' => System::GenerateFormattedId('S', $order->id),
            'order_id' => $order->id,
            'invoice_no' => System::GenerateFormattedId('I', $order->invoice->id),
            'currency' => $order->service->currency,
            'date_issued' => date('F d, Y', strtotime($order->invoice->created_at)),
            'date_due' => date('F d, Y', strtotime($order->invoice->date_due)),
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
            'order_date' => $order->details->render_date,
            'add_charges' => [],
            'payment_method' => $order->details->payment_method,
            'transaction_fee' => $order->invoice->transaction_fee,
            'processing_fee' => $order->invoice->processing_fee,
            'add_charges' => $order->invoice->add_charges,
            'total' => $order->invoice->total,
            'invoice_status'  => $order->invoice->status
        ];
        
        return view('backer.contents.orders-invoice',$data);
    }

    public function create(){

    }

    public function cancel(Request $request){

        $request->validate(['reason' => 'required|string|max:500']);
        $order = Order::find($request->order_id);


        // $request->validate(['reason' => 'required|string|max:500']);

        // $request->validate(['reason' => 'required|string|max:500']);
        
        // $order = Order::where('id',$request->order_id)->with('service')->first();

        // if(!$order)
        //     abort(404, 'Page not found.');

        // if($order->service->jobseeker->id != auth()->user()->id)
        //     abort(403, 'Unauthorized action.');
        
        $order = Order::find($request->order_id);;
        // ERROR $order
        $backer = User::find($order->backer->id);
        // $backer = User::find(auth()->user()->id);
        $jobseeker = USer::find($order->service->jobseeker->id);
        // $jobseeker = USer::where('id',$order->service->jobseeker->id)->first();

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
            $jobseeker = USer::find($order->service->jobseeker->id);

            $jobseeker->notify(new OrderCancelledNotification($order));
            $backer->notify(new OrderCancelledNotification($order));

            Mail::to($backer->email)->queue(new SendMail('emails.order-cancel-request-mail', [
                'subject' => 'Service Order Cancelled',
                'order_id' => System::GenerateFormattedId('S', $order->id),
                'reason' => $cancel->reason

            ]));
            Mail::to($jobseeker->email)->queue(new SendMail('emails.order-cancelled-mail', [
                'subject' => 'Service Order Cancelled',
                'order_id' => System::GenerateFormattedId('S', $order->id),
                'reason' => $cancel->reason
            ]));

            return response()->json(['success' => true, 'msg' => 'Order Cancelled.']); 
        }
        else
        {
            return response()->json(['error' => false, 'msg' => 'Cancel Order Not Permitted.']);
        }
        
    }
}
