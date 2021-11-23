<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Mail\SendMail;
use App\Models\Payout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\Notifications\PayoutSuccessful as PayoutSuccessulNotification;

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

       if($payout->status == 'paid'){
            $jobseeker = User::find($payout->user->id);
            $jobseeker->notify(new PayoutSuccessulNotification());
            Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.order-payout-mail', [
                'subject' => 'Withdraw Service Earnings Successful',
                'amount' => $payout->amount,
                'details' => $payout->details
            ]));

       }

        if($payout)
            return response()->json(['success' => true, 'msg' => 'Payout Status Updated.']);
    }
}
