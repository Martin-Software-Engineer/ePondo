<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class PublicCampaignController extends Controller
{
    public function index(){
        
        $campaigns = Campaign::paginate(5);
        
        return view ('public.campaigns.index',['campaigns' => $campaigns]);
    }

    public function show($campaign_id){
        
        $campaign = Campaign::where('id',$campaign_id)->first();
        
        // return view ('public.campaigns.index',['campaigns' => $campaigns]);
        // $campaign_id = $campaign->id;
        // $job = Job::where('campaign_id',$campaign_id)->paginate(5);
        return view('public.campaigns.show', compact('campaign'));
    }
    
}
