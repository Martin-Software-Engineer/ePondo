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
    
}
