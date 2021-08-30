<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\User;
use App\Models\Photo;
use App\Helpers\GiveReward;
use App\Models\User4psInfo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $data['pppp'] = auth()->user()->pppp;
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

        $reward = new GiveReward($user->id, 'edit_public_profile');
        $reward->send();

        // $pppp = User4psInfo::where('user_id',$user->id)->first();

        // if(!$pppp){
        //     $photo_id = null;

        //     if($request->hasFile('4psId')){
        //         $image = $request->file('4psId');
        //         $fileName   = time() . '.' . $image->getClientOriginalExtension();
        //         $upload = $request->file('4psId')->storeAs('/4ps',$fileName,'public');

        //         $photo = new Photo();
        //         $photo ->filename =  $fileName;
        //         $photo ->url = 'public/4ps/'.$fileName;
        //         $photo ->save();
    
        //         $photo_id = $photo->id;
        //     }

        //     User4psInfo::create([
        //         'user_id' => $user->id,
        //         'id_photo' => $photo_id,
        //         'question1' => $request->question1,
        //         'question2' => $request->question2,
        //         'question3' => $request->question3,
        //         'question4' => $request->question4
        //     ]);

        // }else{

        //     if($request->hasFile('4psId')){
        //         $image = $request->file('4psId');
        //         $fileName   = time() . '.' . $image->getClientOriginalExtension();
                
        //         $upload = $request->file('4psId')->storeAs('/4ps',$fileName,'public');
    
        //         $photo = new Photo();
        //         $photo ->filename =  $fileName;
        //         $photo ->url = 'public/4ps/'.$fileName;
        //         $photo ->save();
    
        //         $pppp->id_photo = $photo->id;
        //     }

        //     $pppp->question1 = $request->question1;
        //     $pppp->question2 = $request->question2;
        //     $pppp->question3 = $request->question3;
        //     $pppp->question4 = $request->question4;
        //     $pppp->save();
        // }
        return response()->json(['success' => true, 'msg' => 'Your public profile was updated.']);
    }

    public function updatepppp(Request $request)
    {
        $user = User::find(auth()->user()->id);
        
        $pppp = User4psInfo::where('user_id',$user->id)->first();

        if(!$pppp){
            $photo_id = null;

            if($request->hasFile('4psId')){
                $image = $request->file('4psId');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                $upload = $request->file('4psId')->storeAs('/4ps',$fileName,'public');

                $photo = new Photo();
                $photo ->filename =  $fileName;
                $photo ->url = 'public/4ps/'.$fileName;
                $photo ->save();
    
                $photo_id = $photo->id;
            }

            User4psInfo::create([
                'user_id' => $user->id,
                'id_photo' => $photo_id,
                'question1' => $request->question1,
                'question2' => $request->question2,
                'question3' => $request->question3,
                'question4' => $request->question4
            ]);

        }else{

            if($request->hasFile('4psId')){
                $image = $request->file('4psId');
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                
                $upload = $request->file('4psId')->storeAs('/4ps',$fileName,'public');
    
                $photo = new Photo();
                $photo ->filename =  $fileName;
                $photo ->url = 'public/4ps/'.$fileName;
                $photo ->save();
    
                $pppp->id_photo = $photo->id;
            }

            $pppp->question1 = $request->question1;
            $pppp->question2 = $request->question2;
            $pppp->question3 = $request->question3;
            $pppp->question4 = $request->question4;
            $pppp->save();
        }
        
        $reward = new GiveReward($user->id, 'edit_public_profile');
        $reward->send();

        return response()->json(['success' => true, 'msg' => 'Your 4Ps profile was updated.']);
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
