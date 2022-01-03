<?php

namespace App\Http\Controllers\Backer;

use App\Models\User;
use App\Mail\SendMail;
use App\Helpers\System;
use Illuminate\Http\Request;
use App\Models\UserInformation;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;

use App\Http\Requests\UpdateAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use App\Notifications\ResetUserPassword as ResetUserPasswordNotification;
use App\Notifications\UserAccountUpdate as UserAccountUpdateNotification;

class AccountController extends Controller
{
    public function index(){
        $user = auth()->user();
        $userInfo = UserInformation::where('user_id', $user->id)->first();

        $data = [
            'firstname' => @$userInfo->firstname,
            'lastname' => @$userInfo->lastname,
            'phone' => @$userInfo->phone,
            'email' => $user->email,
            'address' => @$userInfo->address,
            'zipcode' => @$userInfo->zipcode, 
        ];
        return view('backer.contents.myaccount', $data);
    }

    public function update(UpdateAccount $request){
        $user = User::find(auth()->user()->id);

        if ($request->hasFile('avatar')) {
            if ($request->file('avatar')->isValid()) {
                // Get image file
                $image = $request->file('avatar');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                $upload = $request->file('avatar')->storeAs('/avatars',$fileName,'public');
                
                $user->avatar = '/storage/avatars/'.$fileName;
                $user->save();

            }
        }

        $userinfo = UserInformation::where('user_id', auth()->user()->id)->first();
        if(!$userinfo){
            UserInformation::create([
                'user_id' => auth()->user()->id,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => $request->phone,
                'address' => $request->address,
                'zipcode' => $request->zipcode
            ]); 
        }else{
            // $userinfo->firstname = $request->firstname;
            // $userinfo->lastname = $request->lastname;
            $userinfo->phone = $request->phone;
            $userinfo->address = $request->address;
            $userinfo->zipcode = $request->zipcode;
            $userinfo->save();
        }

        $user->notify(new UserAccountUpdateNotification());
        Mail::to($user->email)->queue(new SendMail('emails.user-account-update-mail', [
            'subject' => 'User Account Information Updated'
        ]));

        return response()->json(['success' => true, 'msg' => 'Account Information Updated']);
    }

    public function changepassword(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', Password::min(8)->mixedCase()->numbers()->symbols()],
            'new_confirm_password' => ['same:new_password']
        ]);
        
        $user = User::where('id',auth()->user()->id)->first();
        $changepass = $user->update(['password'=> Hash::make($request->new_password)]);

        $user->notify(new ResetUserPasswordNotification());
        Mail::to($user->email)->queue(new SendMail('emails.reset-user-password-mail', [
            'subject' => 'Password Changed'
        ]));

        if($changepass){
            return response()->json(['success' => true, 'msg' => 'Account Password Updated']);
        }
    }
}
