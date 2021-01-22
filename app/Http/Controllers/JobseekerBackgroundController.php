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
        // href="{{ route('jobseeker.backgroundinformation.create') }}"
        // return view('jobseeker.background.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
