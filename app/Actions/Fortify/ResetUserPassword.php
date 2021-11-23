<?php

namespace App\Actions\Fortify;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use App\Notifications\ResetUserPassword as ResetUserPasswordNotification;

class ResetUserPassword implements ResetsUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function reset($user, array $input)
    {
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ])->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();

        $user->notify(new ResetUserPasswordNotification());
        Mail::to($user->email)->queue(new SendMail('emails.reset-user-password-mail', [
            'subject' => 'Password Changed'
        ]));

    }
}
