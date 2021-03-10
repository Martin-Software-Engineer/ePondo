<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Service;
use App\Models\ServiceRating;

class PagesController extends Controller
{
    public function index(){
        $data['campaigns'] = Campaign::take(12)->get();
        $data['services'] = Service::take(12)->get();
        return view('landing.contents.index', $data);
    }

    public function campaigns(){
        $data['campaigns'] = Campaign::all();
        return view('landing.contents.campaigns', $data);
    }

    public function campaign_view($id){
        if(!Campaign::find($id)){
            abort(404);
        }

        $data['campaign'] = Campaign::with(['categories','jobseeker'])->where('id',$id)->first();
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

    public function services(){
        $data['services'] = Service::all();
        return view('landing.contents.services', $data);
    }

    public function service_view($id){
        $data['service'] = Service::with(['categories','jobseeker'])->where('id',$id)->first();
        return view('landing.contents.service_view', $data);
    }

    public function aboutus(){
        return view('landing.contents.aboutus');
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
