<?php

namespace App\Http\Controllers\JobSeeker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;;
use App\Models\ClaimedDonations;
class ClaimFundsController extends Controller
{
    public function index($id){
        $data['campaign'] = Campaign::find($id);

        return view('jobseeker.contents.claimfunds', $data);
    }

    public function claim(Request $request){
        $campaign = Campaign::find($request->campaign_id);

        if($campaign->available_funds < $request->amount){
            return response()->json(['success' => false, 'msg' => 'Available funds is not enough'], 404);
        }

        $claim = ClaimedDonations::create([
            'user_id' => auth()->user()->id,
            'campaign_id' => $campaign->id,
            'amount' => $request->amount, 
            'paypal' => $request->paypal,
            'details' => $request->details,
            'status' => 'pending'
        ]);

        if($claim)
            return response()->json(['success' => true, 'msg' => 'Claim fund request successfully submitted']);
    }
}
