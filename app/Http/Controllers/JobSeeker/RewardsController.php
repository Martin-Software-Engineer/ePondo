<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\System;
class RewardsController extends Controller
{
    public function index(){
        $cpoints = auth()->user()->rewards->sum('points');

        $data = array(
            'rewards' => auth()->user()->rewards,
            'current_points' => $cpoints,
            'progress' => System::RewardsProgress($cpoints),
            'badge' => System::RewardsTier($cpoints) != 'no-star' ? 'star-'.System::RewardsTier($cpoints).'.png' : 'no-star.png',
            'next_tier' => System::RewardsNextTier($cpoints)
        );
        //return $data;
        return view('jobseeker.contents.rewards', $data);
    }
}
