<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Order;
use App\Models\Payout;
class EarningsController extends Controller
{
    public function index(){
        $services = Service::select('id')->where('user_id', auth()->user()->id)->get();
        $services_ids = [];
        foreach($services as $service){
            array_push($services_ids, $service->id);
        }

        $earnings = auth()->user()->earnings;
        $withdrawn = Payout::where('user_id', auth()->user()->id)->where('status', 'paid')->get()->sum('amount');
        $pendings = Payout::where('user_id', auth()->user()->id)->where('status', 'pending')->get()->sum('amount');
        $available = $earnings - ($withdrawn + $pendings);
        $data['earnings'] = $earnings;
        $data['withdrawn'] = $withdrawn;
        $data['pendings'] = $pendings;
        $data['available'] = $available;
        $data['payouts'] = Payout::where('user_id', auth()->user()->id)->get();
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

        if($payout){
            return response()->json(['success' => true, 'msg' => 'Withdrawal Request Submitted']);
        }
    }
}
