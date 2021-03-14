<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Order;
use App\Models\OrderDetail;

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
            'service_id' => $service->id,
            'status' => 5
        ]);

        $details = OrderDetail::create([
            'order_id' => $order->id,
            'render_date' => $request->render_date,
            'delivery_address' => $request->delivery_address,
            'message' => $request->message
        ]);

        return response()->json(array(
                'success' => true, 
                'service' => $service,
                'order' => $order,
                'currency' => ucfirst($request->currency)            
            )
        );
    }
}
