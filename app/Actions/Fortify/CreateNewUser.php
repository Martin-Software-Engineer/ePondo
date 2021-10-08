<?php

namespace App\Actions\Fortify;

use App\Models\Role;
use App\Models\User;
use App\Mail\SendMail;
use App\Models\Reward;
use App\Mail\WelcomeMail;
use App\Helpers\GiveReward;
use App\Models\UserAddress;
use Illuminate\Support\Str;
use App\Models\UserInformation;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Notifications\CreateAccount as CreateAccountNotification;

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
            'password' => $this->passwordRules(),
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
        
        //give reward pts for jobseeker
        if($input['role'] == 2)
        {
            $reward = new GiveReward($user->id, 'create_account');
            $reward->send();

        }

        $user->notify(new CreateAccountNotification());
        
        Mail::to($user->email)->queue(new SendMail('emails.welcome-mail', [
            'subject' => 'Welcome to ePondo!'
        ]));
        
        return $user;
    }
}
