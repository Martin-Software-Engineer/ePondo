<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Orders as ResourceOrders;
use App\Models\Order;

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
}
