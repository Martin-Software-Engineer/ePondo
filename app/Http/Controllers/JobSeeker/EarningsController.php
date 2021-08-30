<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\Order;
use App\Mail\SendMail;
use App\Models\Payout;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\ClaimedDonations;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EarningsController extends Controller
{
    public function index(){
        $user = auth()->user();
        // $services = Service::select('id')->where('user_id', $user->id)->get();
        // $services_ids = [];
        // foreach($services as $service){
        //     array_push($services_ids, $service->id);
        // }

        $earnings = $user->earnings;
        $withdrawn = Payout::where('user_id', $user->id)->where('status', 'paid')->get()->sum('amount');
        $pendings = Payout::where('user_id', $user->id)->where('status', 'pending')->get()->sum('amount');
        $available = $earnings - ($withdrawn + $pendings);

        $service['earnings'] = $earnings;
        $service['withdrawn'] = $withdrawn;
        $service['pendings'] = $pendings;
        $service['available'] = $available;

        $service['payouts'] = Payout::where('user_id', $user->id)->get();
        $service['history'] = Invoice::with('order')->whereHas('order', function($q) use($user){
            $q->whereHas('transactions', function($trans){
                $trans->where('status', 'approved');
            });
            $q->whereHas('service', function($service) use($user){
                $service->where('user_id', $user->id);
            });
        })->get();

        $campaigns = Campaign::with('donations')->where('user_id', $user->id)->whereHas('donations', function($q){
            $q->whereHas('transactions', function($q2){
                $q2->where('status', 'approved');
            });
        })->get();

        $totalfunds = 0;
        foreach($campaigns as $c){
            foreach($c['donations'] as $d){
                $totalfunds += $d->amount;
            }
        }
        
        $claimed = ClaimedDonations::where('user_id', $user->id)->where('status', 'paid')->get()->sum('amount');
        $pendingClaims = ClaimedDonations::where('user_id', $user->id)->where('status', 'pending')->get()->sum('amount');
        $availableFunds = $totalfunds - ($claimed + $pendingClaims);

        $claimed_requests = ClaimedDonations::with('campaign')->where('user_id', $user->id)->get();
        $campaign['campaigns'] = $campaigns;
        
        $campaign['claimed_requests'] = $claimed_requests;
        $campaign['totalfunds'] = $totalfunds;
        $campaign['claimed'] = $claimed;
        $campaign['pendings'] = $pendingClaims;
        $campaign['available'] = $availableFunds;

        $data['service_earnings'] = $service;
        $data['campaign_funds'] = $campaign;

        //return $data;
        return view('jobseeker.contents.earnings', $data);
    }


    public function withdraw(Request $request){
        $payout = Payout::create([
            'user_id' => auth()->user()->id,
            'amount' => $request->amount,
            'for' => 'Withdraw',
            'details' => $request->details,
            'status' => 'pending'
        ]);

        Mail::to(auth()->user()->email)->queue(new SendMail('emails.jobseeker.order-payoutrequest-mail', [
            'subject' => 'Payout Request Sent',
            'amount' => $request->amount,
            'details' => $request->details
        ]));

        if($payout){
            return response()->json(['success' => true, 'msg' => 'Withdrawal Request Submitted']);
        }
    }
}
