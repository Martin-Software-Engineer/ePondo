<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Mail\SendMail;

use Illuminate\Http\Request;

use App\Models\ClaimedDonations;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Notifications\ClaimFundsSuccessful as ClaimFundsSuccessfulNotification;

class ClaimDonationRequestsController extends Controller
{
    public function index(){
        $data['claimrequests'] = ClaimedDonations::with(['user', 'campaign'])->get();

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

        if($payout->status == 'paid'){
            $jobseeker = User::where('id',$payout->user->id)->first();
            $jobseeker->notify(new ClaimFundsSuccessfulNotification());
            Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.claimfunds-successful-mail', [
                'subject' => 'Claim Funds Successful',
                'campaign' => $payout->campaign->title,
                'amount' => $payout->amount,
                'details' => $payout->details
            ]));
        }

        if($payout)
            return response()->json(['success' => true, 'msg' => 'Payout Status Updated.']);
        
    }
}
