<?php

namespace App\Http\Controllers;

use App\Models\JobseekerBackground;
use Illuminate\Http\Request;

class JobseekerBackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('jobseeker.background.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = \Validator::make($request->all(), [
        $data = $request->validate([
            
            'user_id' => 'required',
            'job' => 'required',
            'employment_type' => 'required',      
            'frequency'           => 'required',          
            'main_source_of_income' => 'required',
            'other_sources_of_income' => 'required',
            'daily_income' => 'required',
            'daily_expenses' => 'required',
            'expenses'        => 'required',              
            'housing' => 'required',
            'meals_day' => 'required',
            'access_water' => 'required',
            'access_electricity' => 'required',
            'clean_clothes' => 'required',

            'kids.*.first_name' => 'required',
            
        ],[
            'kids.*.first_name' => 'First Name is required',
        ]);
        
        foreach($data['names'] as $image){
            
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobseekerBackground  $jobseekerBackground
     * @return \Illuminate\Http\Response
     */
    public function show(JobseekerBackground $jobseekerBackground)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobseekerBackground  $jobseekerBackground
     * @return \Illuminate\Http\Response
     */
    public function edit(JobseekerBackground $jobseekerBackground)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobseekerBackground  $jobseekerBackground
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobseekerBackground $jobseekerBackground)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobseekerBackground  $jobseekerBackground
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobseekerBackground $jobseekerBackground)
    {
        //
    }
}
