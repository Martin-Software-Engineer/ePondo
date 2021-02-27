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
}
