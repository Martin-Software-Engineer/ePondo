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
        // return view('jobseeker.background.create');
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
        // dd(auth()->user()->id);
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
            // 'answers.*.answer' => 'required',
            // 'kids.*.first_name' => 'required_with:kids.*.last_name',
            
            
            
            // 'names.*' => 'required',
            // 'images.*' => 'required'
            
        ],[
            'kids.*.first_name' => 'First Name is required',
        ]);
        
        foreach($data['names'] as $image){
            
            // $path = Storage::disk('s3')->put(
            //     'campaign', $image, 'public'
            // );
        }


        // $campaign = new Campaign();
        // $campaign -> user_id = auth()->user()->id;
        // $campaign -> title = $data['title'];
        // $campaign -> description = $data['description'];
        // $campaign -> save();

        // $table->id();
        //     $table->unsignedBigInteger('user_id');

        //     // $table->string('kids');                         //no. of kids

        //     $table->string('job');
        //     $table->string('employment_type');              //Full,Part,Commission
        //     $table->string('frequency');                    //how long or often you get to work 1 day a week/everyday
        //     $table->string('main_source_of_income');
        //     $table->string('other_sources_of_income');

        //     $table->string('daily_income');
        //     $table->string('daily_expenses');
        //     $table->string('expenses');                     //what are their (daily) expenses ?

        //     $table->string('housing');
        //     $table->string('meals_day');
        //     $table->string('access_water');
        //     $table->string('access_electricity');
        //     $table->string('clean_clothes');
        //     $table->timestamps();
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
