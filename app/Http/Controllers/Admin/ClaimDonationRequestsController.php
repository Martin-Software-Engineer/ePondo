<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ClaimedDonations;

class ClaimDonationRequestsController extends Controller
{
    public function index(){
        $data['claimrequests'] = ClaimedDonations::with(['user', 'campaign'])->get();

        //return $data;
        return view('admin.contents.claimrequest.index', $data);
    }

    public function view($id){
        $data['claimrequest'] = ClaimedDonations::where('id',$id)->with('user')->first();

        return view('admin.contents.claimrequest.view', $data);
    }

    public function update_status(Request $request, $id){
        $payout = ClaimedDonations::find($id);
        $payout->status = $request->status;
        $payout->save();

        if($payout)
            return response()->json(['success' => true, 'msg' => 'Claim Request Status Updated.']);
    }
}
