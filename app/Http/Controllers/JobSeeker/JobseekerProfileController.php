<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\User;
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
        $data['kids'] = auth()->user()->kids;
        $data['dependents'] = auth()->user()->dependents;
        $data['info'] = auth()->user()->information;
        $data['skills'] = auth()->user()->skills;
        $data['workexperiences'] = auth()->user()->workexperiences;
        //return $data;
        return view('jobseeker.contents.public-profile', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobseekerProfile  $jobseekerProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);

        $user->kids()->delete();
        $user->dependents()->delete();
        $user->skills()->delete();
        $user->workexperiences()->delete();
        if($request->get('kids')){
            foreach($request->get('kids') as $kid){
                if($kid['name'] != NULL){
                    $user->kids()->create([
                        'fullname' => $kid['name'],
                        'age' => $kid['age']
                    ]);
                }
            }
        }
        if($request->get('dependents')){
            foreach($request->get('dependents') as $kid){
                if($kid['name'] != NULL){
                    $user->dependents()->create([
                        'fullname' => $kid['name'],
                        'age' => $kid['age'],
                        'relation' => $kid['relation']
                    ]);
                }
            }
        }
        if($request->get('workexp')){
            foreach($request->get('workexp') as $workexp){
                if($workexp['company'] != NULL){
                    $user->workexperiences()->create([
                        'company' => $workexp['company'],
                        'description' => $workexp['description'],
                        'year' => $workexp['year']
                    ]);
                }
            }
        }

        if($request->get('skills')){
            foreach($request->get('skills') as $skill){
                if($skill['name'] != NULL){
                    $user->skills()->create([
                        'work_skill' => $skill['name']
                    ]);
                }
            }
        }

        $user->information()->update([
            'current_job' => $request->current_job,
            'employment_type' => $request->employment_type,
            'freq_of_work' => $request->freq_of_work,
            'main_source_income' => $request->main_source_income,
            'extra_source_income' => $request->extra_source_income,
            'skills' => $request->skills,
            'daily_income' => $request->daily_income,
            'daily_expenses' => $request->daily_expenses,
            'bio' => $request->bio,
            'type_of_housing' => $request->type_of_housing,
            'daily_meals' => $request->daily_meals,
            'water_access' => $request->water_access,
            'electricity_access' => $request->electricity_access,
            'clean_clothes_access' => $request->clean_clothes_access
        ]);

        return response()->json(['success' => true, 'msg' => 'Your public profile was updated.']);
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
