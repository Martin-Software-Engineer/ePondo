<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\ServiceRating;
use App\Models\ServiceCategory;
use App\Models\CampaignCategory;
use Illuminate\Support\Facades\Redirect;

class PagesController extends Controller
{
    public function index(){
        $data['campaigns'] = Campaign::take(3)->get();
        $data['services'] = Service::take(3)->get();
        return view('landing.contents.index', $data);
    }

    public function campaigns(Request $request){
        $campaigns = Campaign::orderBy('created_at', 'desc');
        if($request->search){   
            $campaigns = $campaigns->where('title', 'like', '%'.$request->search.'%');
        }
        if($request->category){
            $category = $request->category;
            $campaigns = $campaigns->whereHas('categories', function($q) use($category){
                $q->where('campaign_category_id', $category);
            });
        }
        
        $data['campaigns'] = $campaigns->paginate(12);
        $data['categories'] = CampaignCategory::all();

        //return $data;
        return view('landing.contents.campaigns', $data);
    }

    public function campaign_view($id){
        if(!Campaign::find($id)){
            abort(404);
        }

        $data['campaign'] = Campaign::with(['categories','jobseeker', 'donations'])->where('id',$id)->first();
        /* 
            1. Get the user_id from campaigns
            2. Find services with the same user_id
            3. Output all data
        */
        $data['services'] = Service::where('user_id', $data['campaign']->user_id)->get();
        //return $data;
        return view('landing.contents.campaign_view', $data);
    }

    public function campaign_details($id){
        if(!Campaign::find($id)){
            abort(404);
        }

        $campaign = Campaign::with(['categories','jobseeker'])->where('id',$id)->first();

        return $campaign;
    }

    public function services(Request $request){

        $services = Service::orderBy('created_at', 'desc');
        if($request->search){   
            $services = $services->where('title', 'like', '%'.$request->search.'%');
        }
        if($request->category){
            $category = $request->category;
            $services = $services->whereHas('categories', function($q) use($category){
                $q->where('service_category_id', $category);
            });
        }
        
        $data['services'] = $services->paginate(12);
        $data['categories'] = ServiceCategory::all();
        return view('landing.contents.services', $data);
    }

    public function service_view($id){
        $data['service'] = Service::with(['categories','jobseeker', 'photos', 'messages','backer_ratings'])->where('id',$id)->first();
        /* 
            1. Get the user_id from campaigns
            2. Find services with the same user_id
            3. Output all data
        */
        $data['campaigns'] = Campaign::where('user_id', $data['service']->user_id)->get();
        return view('landing.contents.service_view', $data);
    }

    public function service_details($id){
        if(!Service::find($id)){
            abort(404);
        }

        $service = Service::with(['categories','jobseeker'])->where('id',$id)->first();

        return $service;
    }

    public function aboutus(){
        return view('landing.contents.aboutus');
    }

    public function howitworks(){
        return view('landing.contents.howitworks');
    }

    public function privacypolicy(){
        return view('landing.contents.privacypolicy');
    }

    public function termsandconditions(){
        return view('landing.contents.termsandconditions');
    }

    public function cookiepolicy(){
        return view('landing.contents.cookiepolicy');
    }

    public function eula(){
        return view('landing.contents.eula');
    }

    public function disclaimer(){
        return view('landing.contents.disclaimer');
    }

    public function jobseeker($id){
        $data['user'] = User::find($id);
        $data['services'] = Service::where('user_id', $id)->get();
        $data['campaigns'] = Campaign::where('user_id', $id)->get();
        $data['raf'] = ServiceRating::with('order')->whereHas('order', function($q1) use ($id){
            $q1->whereHas('service', function($q2) use ($id) {
                $q2->where('user_id', $id);
            });
        })->get();

        return view('landing.contents.jobseeker_profile', $data);
    }
}
