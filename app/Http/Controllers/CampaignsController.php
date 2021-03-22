<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;

class CampaignsController extends Controller
{
    public function donate(Request $request){
        $donate = Donation::create([
            'message' => $request->message,
            'amount' => $request->amount
        ]);

        $campaign = Campaign::find($request->campaign_id);
        $campaign->donations()->attach($donate->id);

        if(!$request->input('is_anonymous')){
            $user = User::where('email', $request->email)->first();
            if($user)
                $user->donations()->attach($donate->id);
        }

        return response()->json(array(
                'success' => true, 
                'donation_id' => $donate->id,
                'donation_amount' => $donate->amount,
                'currency' => strtoupper($request->currency)
            )
        );
    }
}
