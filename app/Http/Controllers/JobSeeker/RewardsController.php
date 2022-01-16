<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\Reward;
use App\Helpers\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RewardsController extends Controller
{
    public function index(){
        $cpoints = auth()->user()->rewards->sum('points');

        $data = array(
            'user'  => auth()->user(),
            'rewards' => auth()->user()->rewards,
            'current_points' => $cpoints,
            'progress' => System::RewardsProgress($cpoints),
            'badge' => System::RewardsTier($cpoints) != 'no-star' ? 'star-'.System::RewardsTier($cpoints).'.png' : 'no-star.png',
            'next_tier' => System::RewardsNextTier($cpoints)
        );
        
        return view('jobseeker.contents.rewards', $data);
    }
}
