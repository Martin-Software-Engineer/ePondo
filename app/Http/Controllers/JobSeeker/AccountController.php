<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\UserInformation;

use App\Http\Requests\UpdateAccountJobseeker;
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
            'birthdate' => @$userInfo->birthdate
        ];
        return view('jobseeker.contents.myaccount', $data);
    }

    public function update(UpdateAccountJobseeker $request){
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
                'phone' => $request->phone,
                'address' => $request->address,
                'zipcode' => $request->zipcode,
                'birthdate' => $request->birthdate
            ]); 
        }else{
            $userinfo->phone = $request->phone;
            $userinfo->address = $request->address;
            $userinfo->zipcode = $request->zipcode;
            $userinfo->birthdate = $request->birthdate;
            $userinfo->save();
        }

        return response()->json(['success' => true, 'msg' => 'Account Information Updated']);
    }

    public function changepassword(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password']
        ]);

        $changepass = User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        if($changepass){
            return response()->json(['success' => true, 'msg' => 'Account Password Updated']);
        }
    }
}
