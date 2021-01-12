<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class PublicJobController extends Controller
{
    public function index(){
        
        $jobs = Job::paginate(5);
        
        return view ('public.jobs.index',['jobs' => $jobs]);
    }
}
