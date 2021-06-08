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
            'amount' => $request->amount
        ]);

        $campaign = Campaign::find($request->campaign_id);
        $campaign->donations()->attach($donate->id);
        $jobseeker = User::find($campaign->user_id);
        if(!$request->input('is_anonymous')){
            $user = User::where('email', $request->email)->first();
            
            if($user){
                $user->donations()->attach($donate->id);
                $jobseeker->notify(new DonateCampaignNotification($user, $campaign));
                $user->notify(new DonateCampaignNotification($user, $campaign));
            }else{
                if (Auth::check()) {
                    $user = User::find(auth()->user()->id);
                    $user->donations()->attach($donate->id);
                    $jobseeker->notify(new DonateCampaignNotification($user, $campaign));
                    $user->notify(new DonateCampaignNotification($user, $campaign));
                    Mail::to(auth()->user()->email)->queue(new SendMail('emails.donation-received-mail', [
                        'subject' => 'Epondo Service'
                    ]));
                }else{
                    $jobseeker->notify(new DonateCampaignNotification((object)['username' => $request->firstname], $campaign));
                }
            }

        }else{
            $jobseeker->notify(new DonateCampaignNotification(null, $campaign));
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
