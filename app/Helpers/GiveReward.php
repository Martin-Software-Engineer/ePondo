<?php 
namespace App\Helpers;

use App\Models\User;
use App\Models\Reward;
use App\Helpers\System;
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
        $user = User::find($this->id);
        $reward = Reward::where('name', $this->rn)->first();
        $cpoints = $user->rewards()->sum('points');
        $ctier = System::RewardsTier($cpoints);
        if($reward){
            $user->rewards()->attach($reward->id);

            $newpoints = $user->rewards()->sum('points');
            $newtier = System::RewardsTier($cpoints);

            $user->notify(new PointsNotification($reward->actions, $reward->points));

            if($ctier != $newtier){
                $user->notify(new RewardsNotification($newtier));
            }

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