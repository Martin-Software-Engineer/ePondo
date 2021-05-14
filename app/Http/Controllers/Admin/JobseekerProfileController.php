<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Jobseekers as ResourceJobseekers;
use App\Models\User;
use App\Models\Role;

use DataTables;
class JobseekerProfileController extends Controller
{
    public function index()
    {
        $data['title'] = 'Jobseeker Public Profile';
        return view('admin.contents.jobseeker.index', $data);
    }

    /**
     * Show all records in json format.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(){
        $role = Role::where('name', 'JobSeeker')->first();
        $results = User::whereHas('roles', function($q) use($role){
            $q->where('role_id', $role->id);
        })->get();

        return DataTables::of(ResourceJobseekers::collection($results))->toJson();
    }

    public function edit($id){
        $user = User::find($id);
        $data['user'] = $user;
        $data['kids'] = $user->kids;
        $data['dependents'] = $user->dependents;
        $data['info'] = $user->information;
        $data['skills'] = $user->skills;
        $data['workexperiences'] = $user->workexperiences;
        //return $data;
        return view('admin.contents.jobseeker.profile', $data);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

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

        return response()->json(['success' => true, 'msg' => 'Jobseeker public profile was updated.']);
    }
}
