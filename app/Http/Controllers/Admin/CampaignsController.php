<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCampaign;
use App\Http\Requests\UpdateCampaign;
use App\Http\Resources\Campaigns as ResourceCampaign;
use App\Models\User;
use App\Models\Campaign;
use App\Models\CampaignCategory;
use App\Models\Photo;
use App\Models\Tag;
use App\Helpers\System;
use DataTables;
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

            $upload = $request->file('thumbnail')->storeAs('/photos',$fileName,'public');
            $photo = new Photo();
            $photo ->filename =  $fileName;
            $photo ->url = 'public/photos/'.$fileName;
            $photo ->save();

            $campaign->thumbnail_id = $photo->id;
            $campaign->save();
        }
        
        if($request->file('images',[])){
            foreach($request->file('images',[]) as $image){
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                $upload = $image->storeAs('/photos',$fileName,'public');
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
        $data['title'] = 'Edit Campaign';
        $data['campaign'] = Campaign::where('id', $id)->with(['categories', 'jobseeker', 'photos', 'tags'])->first();
        $data['categories'] = CampaignCategory::all();
        $data['jobseekers'] = User::whereHas('roles', function($q){
            $q->where('name', 'JobSeeker');
        })->get();

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
        
        if($request->file('images',[])){
            $campaign->photos()->detach();
            foreach($request->file('images',[]) as $image){
                $fileName   = time() . '.' . $image->getClientOriginalExtension();
                $upload = $image->storeAs('/photos',$fileName,'public');
                $photo = new Photo();
                $photo ->filename =  $fileName;
                $photo ->url = 'public/photos/'.$fileName;
                $photo ->save();

                $campaign->photos()->attach($photo->id);
            }
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

        return response()->json(['success' => true,'msg' => trans('admin.campaign.update.success')]);
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
