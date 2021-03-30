<?php

namespace App\Http\Controllers\Backer;

use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserInformation;
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

    public function update(Request $request){

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password']
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        
        if(!UserInformation::where('user_id', auth()->user()->id)->exists())
        $update = UserInformation::updateOrCreate([
            'user_id' => auth()->user()->id,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'address' => $request->address,
            'zipcode' => $request->zipcode
        ]);

        if($update){
            return response()->json(['success' => true, 'msg' => 'Account Information Updated']);
        }
    }
}
