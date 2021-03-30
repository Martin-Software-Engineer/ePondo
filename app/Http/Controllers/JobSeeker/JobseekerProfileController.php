<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\JobseekerProfile;
use Illuminate\Http\Request;


class JobseekerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('jobseeker.contents.public-profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @param  \App\Models\JobseekerProfile  $jobseekerProfile
     * @return \Illuminate\Http\Response
     */
    public function show(JobseekerProfile $jobseekerProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobseekerProfile  $jobseekerProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(JobseekerProfile $jobseekerProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobseekerProfile  $jobseekerProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobseekerProfile $jobseekerProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobseekerProfile  $jobseekerProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobseekerProfile $jobseekerProfile)
    {
        //
    }
}
