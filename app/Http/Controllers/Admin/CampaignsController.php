<?php

namespace App\Http\Controllers\Admin;

use Image;
use DataTables;
use App\Models\Tag;
use App\Models\User;
use App\Models\Photo;
use App\Mail\SendMail;
use App\Helpers\System;
use App\Models\Campaign;
use App\Models\Donation;
use App\Helpers\GiveReward;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CampaignCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCampaign;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests\UpdateCampaign;
use App\Http\Resources\Campaigns as ResourceCampaign;
use App\Notifications\CreateCampaign as CreateCampaignNotification;
use App\Notifications\EditCampaign as EditCampaignNotification;
use App\Notifications\DeleteCampaign as DeleteCampaignNotification;

class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Campaigns';
        
        return view('admin.contents.campaigns.index', $data);
    }

    /**
     * Show all records in json format.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(){
        $results = Campaign::with(['jobseeker','donations'])->get();
        return DataTables::of(ResourceCampaign::collection($results))->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create Campaign';
        $data['categories'] = CampaignCategory::all();
        $data['jobseekers'] = User::whereHas('roles', function($q){
            $q->where('name', 'JobSeeker');
        })->get();

        return view('admin.contents.campaigns.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaign $request)
    {
        $jobseeker = User::find($request->jobseeker_id);
        $totalcampaigns = Campaign::where('user_id', $jobseeker->id)->count(); //Counter for Reward Points
        $campaign = Campaign::create([
            'user_id' => $request->jobseeker_id,
            'title' => $request->title,
            'description' => $request->description,
            'target_date' => $request->target_date,
            'target_amount' => $request->target_amount
        ]);

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();
            
            $destinationPath = storage_path('app/public/photos');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 666, true);
            }

            $img = Image::make($image->path());
            $img->resize(350, 350)->save($destinationPath."/".$fileName);

            $photo = new Photo();
            $photo ->filename =  $fileName;
            $photo ->url = 'public/photos/'.$fileName;
            $photo ->save();

            $campaign->thumbnail_id = $photo->id;
            $campaign->save();
        }

        if($request->file('images',[])){
            foreach($request->file('images',[]) as $image){
                $fileName   = Str::random(3).time() . '.' . $image->getClientOriginalExtension();

                $destinationPath = storage_path('app/public/photos');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 666, true);
                }
    
                $img = Image::make($image->path());
                $img->resize(400, 350)->save($destinationPath."/".$fileName);

                $photo = new Photo();
                $photo ->filename =  $fileName;
                $photo ->url = 'public/photos/'.$fileName;
                $photo ->save();

                $campaign->photos()->attach($photo->id);
            }
            
        }
        
        if($request->input('category', [])){
            foreach($request->input('category', []) as $category){
                $campaign->categories()->attach($category);
            }
        }

        if($request->input('tags')){
            $tags = explode(',', $request->tags);
            foreach($tags as $tag){
                $tagStore = Tag::create(['name' => $tag]);
                $campaign->tags()->attach($tagStore->id);
            }
        }

        Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.campaign-mail', [
            'subject' => 'Successfully Created Campaign',
            'jobseeker_name' => $jobseeker->userinformation->firstname.' '.$jobseeker->userinformation->lastname,
            'campaign' => $campaign
        ]));
        
        $jobseeker->notify(new CreateCampaignNotification());
        
        //Reward Points
        if(!$totalcampaigns > 0){
            $reward = new GiveReward($jobseeker->id, 'creating_1st_campaign');
            $reward->send();
        }else{
            $reward = new GiveReward($jobseeker->id, 'creating_campaign');
            $reward->send();
        }

        return response()->json(['success' => true,'msg' => trans('admin.campaign.create.success')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $data['title'] = 'View Campaign';
        $campaign = Campaign::where('id', $id)->with(['categories', 'jobseeker', 'photos', 'tags'])->first();
        $data = [
            'title' => 'View Campaign',
            'campaign_id' => $campaign->id,
            'campaign_no' => System::GenerateFormattedId('C', $campaign->id),
            'campaign_title' => $campaign->title,
            'campaign_categories' => $campaign->categories,
            'campaign_desc' => $campaign->description,
            'created_date' => date('F d, Y', strtotime($campaign->created_at)),
            'target_date' => date('F d, Y', strtotime($campaign->target_date)),
            'target_amount' => $campaign->target_amount,
            'raised_amount' => $campaign->donations()->sum('amount'),
            'campaign_status' => $campaign->status,

            'user_id' => $campaign->jobseeker->id,
            'jobseeker_id' => System::GenerateFormattedId('J', $campaign->jobseeker->id),
            'jobseeker_username' => $campaign->jobseeker->username,
            'jobseeker_firstname' => $campaign->jobseeker->information->firstname,
            'jobseeker_lastname' => $campaign->jobseeker->information->lastname,
            'jobseeker_email' => $campaign->jobseeker->email,
            'jobseeker_contact' => $campaign->jobseeker->information->phone,

            'donations' => $campaign->donations
        ];

        // $data['donations'] = Donation::whereHas('transactions', function($q){
        //     $q->where('status', 'approved');
        // })->with('backer')->get();

        // <!-- Campaign No.
        //     Status
        //     Title
        //     Category
        //     Description
        //     Created Date
        //     Target Date
        //     Target Amount
        //     Raised Amount

        //     Jobseeker ID
        //     Username
        //     FirstName
        //     LastName
        //     Email -->

        return view('admin.contents.campaigns.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Campaign';
        $data['campaign'] = Campaign::where('id', $id)->with(['categories', 'jobseeker', 'photos', 'tags'])->first();
        $data['categories'] = CampaignCategory::all();
        
        return view('admin.contents.campaigns.edit', $data);
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
        $campaign = Campaign::find($id);
        $campaign->user_id = $request->jobseeker_id;
        $campaign->title = $request->title;
        $campaign->description = $request->description;
        $campaign->target_date = $request->target_date;
        $campaign->target_amount = $request->target_amount;
        $campaign->status = $request->status;
        $campaign->save();

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $upload = $request->file('thumbnail')->storeAs('/photos',$fileName,'public');
            $photo = new Photo();
            $photo ->filename =  $fileName;
            $photo ->url = 'public/photos/'.$fileName;
            $photo ->save();

            $campaign->thumbnail_id = $photo->id;
            $campaign->save();
        }
        
        if($request->get('category', [])){
            $campaign->categories()->sync($request->get('category', []));
        }else{
            $campaign->categories()->detach();
        }

        if($request->input('tags')){
            $tags = explode(',', $request->tags);
            $campaign->tags()->detach();
            foreach($tags as $tag){
                $tagStore = Tag::create(['name' => $tag]);
                $campaign->tags()->attach($tagStore->id);
            }
        }else{
            $campaign->tags()->detach();
        }

        $jobseeker = User::where('id',$campaign->user_id)->first();

        if($campaign->status == 2){
            Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.campaign-delete-mail', [
                'subject' => 'Campaign - Deleted',
                'jobseeker_name' => $jobseeker->userinformation->firstname.' '.$jobseeker->userinformation->lastname,
                'campaign' => $campaign
            ]));
            $jobseeker->notify(new DeleteCampaignNotification($campaign));
        }else{
            Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.campaign-edit-mail', [
                'subject' => 'Campaign - Edited Successfully',
                'jobseeker_name' => $jobseeker->userinformation->firstname.' '.$jobseeker->userinformation->lastname,
                'campaign' => $campaign
            ]));
            $jobseeker->notify(new EditCampaignNotification($campaign));
        }

        return response()->json(['success' => true,'msg' => trans('admin.campaign.update.success')]);
    }

    public function updatephotos(Request $request){
        $campaign = Campaign::findOrFail($request->id);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $upload = $request->file('image')->storeAs('/photos',$fileName,'public');
            if($request->has('photo_id')){
                $photo = $campaign->photos()->where('photo_id', $request->photo_id)->first();
                $photo ->filename =  $fileName;
                $photo ->url = 'public/photos/'.$fileName;
                $photo ->save();
            }else{
                $photo = new Photo();
                $photo ->filename =  $fileName;
                $photo ->url = 'public/photos/'.$fileName;
                $photo ->save();

                $campaign->photos()->attach($photo->id);
            }
        }

        return response()->json(['success' => true, 'msg' => 'Photos Updated']);
    }
        
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = Campaign::find($id)->delete();
        if($destroy)
        return response()->json(array('success' => true, 'msg' => 'Campaign Deleted'));
    }
}