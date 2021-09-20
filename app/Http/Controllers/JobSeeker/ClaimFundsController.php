<?php

namespace App\Http\Controllers\JobSeeker;
use App\Models\User;
use App\Mail\SendMail;
use App\Models\Campaign;;
use Illuminate\Http\Request;
use App\Models\ClaimedDonations;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\Notifications\ClaimFundsRequest as ClaimFundsRequestlNotification;

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
        $jobseeker=User::where('id',auth()->user()->id)->first();
        $jobseeker->notify(new ClaimFundsRequestlNotification());
        // Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.claimfunds-mail', [
        //     'subject' => 'Claim Funds Successful',
        //     'campaign' => $claim->campaign->title,
        //     'amount' => $claim->amount,
        //     'details' => $claim->details
        // ]));

        if($claim)
            return response()->json(['success' => true, 'msg' => 'Claim funds request successfully submitted']);
    }
}
