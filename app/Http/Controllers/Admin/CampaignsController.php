<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Request\StoreCampaign as StoreCampaignRequest;
use App\Http\Resources\Campaigns as ResourceCampaign;
use App\Models\Campaign;
use App\Models\Photo;

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
        return view('admin.contents.campaigns.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaignRequest $request)
    {
        $campaign = Campaign::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description
        ]);

        $campaign->categories()->attach($request->category_id);

        foreach($request->input('images',[]) as $image){ 
            $path = Storage::disk('s3')->put(
                'campaign', $image, 'public'
            );

            $photo = new Photo();
            $photo ->filename = basename($path);
            $photo ->url = Storage::url($path);
            $photo -> save();
                
            $campaign->photos()->attach($photo->id);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
