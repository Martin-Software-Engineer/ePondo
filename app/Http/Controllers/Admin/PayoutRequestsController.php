<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payout;

class PayoutRequestsController extends Controller
{
    public function index(){
        $data['payouts'] = Payout::all();
        return view('admin.contents.payouts.index', $data);
    }

    public function view($id){
        $data['payout'] = Payout::where('id',$id)->with('user')->first();

        return view('admin.contents.payouts.view', $data);
    }

    public function update_status(Request $request, $id){
        $payout = Payout::find($id);
        $payout->status = $request->status;
        $payout->save();

        if($payout)
            return response()->json(['success' => true, 'msg' => 'Payout Status Updated.']);
    }
}
