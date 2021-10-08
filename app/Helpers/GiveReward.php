<?php 
namespace App\Helpers;

use App\Models\User;
use App\Mail\SendMail;
use App\Models\Reward;
use App\Helpers\System;
use Illuminate\Support\Facades\Mail;
use App\Notifications\Points as PointsNotification;
use App\Notifications\Rewards as RewardsNotification;

class GiveReward{

    protected $id; //user id
    protected $rn; //reward name

    public function __construct($id, $rn){
        $this->id = $id;
        $this->rn = $rn;
    }

    public function send(){
        $user = User::find($this->id); //get user id
        $reward = Reward::where('name', $this->rn)->first(); //get reward data from Rewards table (actions,points)
        $cpoints = $user->rewards()->sum('points'); //get users reward points sum
        $ctier = System::RewardsTier($cpoints);  //get equivalent tier (silver,gold,platinum)
        if($reward){
            $user->rewards()->attach($reward->id); //give reward to user

            // $newpoints = $user->rewards()->sum('points');
            // $newtier = System::RewardsTier($cpoints);
            
            $newpoints = $user->rewards()->sum('points'); //get users new rewards points sum
            $newtier = System::RewardsTier($newpoints); //get users new equivalent tier

            $user->notify(new PointsNotification($reward->actions, $reward->points)); //Notify user of the reward given

            if($ctier != $newtier){
                if( $newtier == 'gold')
                {
                    $newtiernotif = 'Gold';
                    $addon = '0.6';
                }
                elseif( $newtier == 'platinum' )
                {
                    $newtiernotif  = 'Platinum';
                    $addon = '1.2';
                }
                else{
                    $newtiernotif  = 'Silver';
                    $addon = '2';
                }
                $user->notify(new RewardsNotification($newtiernotif));
                Mail::to($user->email)->queue(new SendMail('emails.jobseeker.tier-rankup-mail', [
                    'subject' => "{$newtiernotif} Rewards Tier Unlocked",
                    'newtiernotif' => $newtiernotif,
                    'addon' => $addon
                ]));

                switch($newtier){
                    case 'gold': 
                        $reward = Reward::where('name', 'reaching_gold_tier')->first();
                        $user->rewards()->attach($reward->id);
                        break;
                    case 'platinum':
                        $reward = Reward::where('name', 'reaching_platinum_tier')->first();
                        $user->rewards()->attach($reward->id);
                        break;
                }
            }
        }

    }
}