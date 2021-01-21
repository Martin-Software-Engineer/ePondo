<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserInformation;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            // 'name' => ['required', 'string', 'max:255'],

            'birth_date' => 'required',
            'age' => 'required',
            'sex' => 'required',
            'marital_status' => 'required',
            'kids' => 'required',
            
            'address_line' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'contact_no' => 'required',

            'education' => 'required',
            'occupation' => 'required',

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],

            'password' => $this->passwordRules(),
            'role' => 'required', // Add validate data for role
            ])->validate();

            // dd($input);

        $firstname = Str::title($input['first_name']);
        $lastname = Str::title($input['last_name']);
        // $middlename = Str::title($input['middle_name']);

        $name = $firstname.' '.$lastname;
        // dd($name);

        $user =  User::create([
            'name' => $name,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            
        ]);


        // $userinfo = UserInformation::create([
        //     'user_id' => $user->id,
        //     'birthdate' => $input['birth_date'],
        //     'age' => $input['age'],
        //     'sex' => $input['sex'],
        //     'marital_status' => $input['marital_status'],
        //     'kids' => $input['kids'],
        //     'education' => $input['education'],
        //     'occupation' => $input['occupation'],
        //     'contact_no' => $input['contact_no'],
        // ]);

        $userinfo = new UserInformation();
        $userinfo -> user_id = $user->id;
        $userinfo -> birthdate = $input['birth_date'];
        $userinfo -> age = $input['age'];
        $userinfo -> sex = $input['sex'];
        $userinfo -> marital_status = $input['marital_status'];
        $userinfo -> kids = $input['kids'];
        $userinfo -> education = $input['education'];
        $userinfo -> occupation = $input['occupation'];
        $userinfo -> contact_no = $input['contact_no'];
        $userinfo -> save();

        // $useraddress = UserAddress::create([
        //     'user_information_id' => $userinfo -> id,
        //     'address_line' =>  $input['address_line'],
        //     'city' =>  $input['city'],
        //     'state' =>  $input['state'],
        //     'postal_code' =>  $input['postal_code'],
        //     'country' =>  $input['country'],
        // ]);

        $useraddress = new UserAddress();
        $useraddress -> user_information_id = $userinfo -> id;
        $useraddress -> address_line =  $input['address_line'];
        $useraddress -> city =  $input['city'];
        $useraddress -> state =  $input['state'];
        $useraddress -> postal_code =  $input['postal_code'];
        $useraddress -> country =  $input['country'];
        $useraddress -> save();

        // dd($user, $userinfo, $useraddress);

        // if($input['role'] = 1){

        //     $role = Role::find(1);

        // }
       
        $user->roles()->attach($input['role']);

        // 'role_id' => $input['role'],
        // $user->roles()->attach($input['role']);
        return $user;
        // $user->roles()->sync($request->roles);
    }
}
