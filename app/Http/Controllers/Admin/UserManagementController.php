<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Rules\Password;

use App\Http\Resources\UserList as ResourceUserList;
use App\Models\User;
use App\Models\Role;

use DataTables;
class UserManagementController extends Controller
{

    public function index()
    {
        $data['title'] = 'User Management';
        return view('admin.contents.users-management.index', $data);
    }

    /**
     * Show all records in json format.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(){
        $results = User::all();
        return DataTables::of(ResourceUserList::collection($results))->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create User';
        $data['roles'] = Role::all();
        return view('admin.contents.users-management.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->input();
        Validator::make($input, [
            'username' => ['required','string','max:64'],
            'firstname' => ['required','string','max:64'],
            'lastname' => ['required','string','max:64'],
            'email' => [
                'required',
                'email',
                'string',
                'max:255',
                Rule::unique(User::class)
            ],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ])->validate();

        $user =  User::create([
            'username' => $input['username'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        
        $user->information()->create([
            'user_id' => $user->id,
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname']
        ]);

        $user->roles()->attach($input['role']);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit User';
        $data['roles'] = Role::all();
        $data['user'] = User::where('id',$id)->with('information', 'roles')->first();

        //return $data;
        return view('admin.contents.users-management.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->input();
        Validator::make($input, [
            'username' => ['required','string','max:64'],
            'firstname' => ['required','string','max:64'],
            'lastname' => ['required','string','max:64'],
            'email' => [
                'required',
                'email',
                'string',
                'max:255',
                'unique:users,email,'.$id
            ],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ])->validate();

        $user = User::find($id);
        $user->username = $input['username'];
        $user->email = $input['email'];
        $user->password = Hash::make($input['password']);
        $user->save();

        $user->information()->update([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname']
        ]);

        $user->roles()->sync($input['role']);

        if($user)
            return response()->json(['success' => true, 'msg' => 'User Information Updated.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = User::find($id)->delete();
        if($destroy)
        return response()->json(array('success' => true, 'msg' => 'User Deleted'));
    }
}
