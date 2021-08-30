<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use App\Notifications\DonateCampaign as DonateCampaignNotification;
use Auth;
class CampaignsController extends Controller
{
    public function donate(Request $request){
        $donate = Donation::create([
            'message' => $request->message,
            'amount' => $request->amount + ($request->amount * 0.03)
        ]);

        $campaign = Campaign::find($request->campaign_id);
        $campaign->donations()->attach($donate->id);
        
        if(!$request->input('is_anonymous')){
            $user = User::where('email', $request->email)->first();
            
            if($user){
                $user->donations()->attach($donate->id);
            }else{
                if (Auth::check()) {
                    $user = User::find(auth()->user()->id);
                    $user->donations()->attach($donate->id);

                }
            }
        }
        //else statement for anonymous {require input of email, to send out confirmation of donation}

        return response()->json(array(
                'success' => true, 
                'donation_id' => $donate->id,
                'donation_amount' => $donate->amount,
                'currency' => strtoupper($request->currency)
            )
        );
    }
}
