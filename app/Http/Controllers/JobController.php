<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Photo;
use App\Models\Campaign;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($campaign_id)
    {
        
        // dd($campaign);
        // $campaign = $campaign -> id;

        // ['campaign_categories' => CampaignCategory::all()]
        // compact('campaign_id')
        return view ('jobseeker.jobs.create',[ 'campaign_id'=> $campaign_id, 'job_categories' => JobCategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($campaign_id, Request $request)
    {

        $data = $request->validate([
            
            'title' => 'required',
            'description' => 'required',
            'job_category' => 'required',
            'images.*' => 'required'
        ]);

        $job = new Job();
        $job -> campaign_id = $campaign_id;
        $job -> title = $data['title'];
        $job -> description = $data['description'];
        $job -> save();

        foreach($data['images'] as $image){
            
            $path = Storage::disk('s3')->put(
                'job', $image, 'public'
            );

            $photo = new Photo();
            $photo -> filename =  basename($path);
            $photo -> url = Storage::url($path);
            $photo -> save();
                
            $job->photos()->attach($photo->id);

        }
        
        $job->job_categories()->attach($request['job_category']);
        
        $request ->session()->flash('success','You have created a New Job!');

        $campaign = Campaign::findOrFail($campaign_id);
        $jobs = Job::where('campaign_id',$campaign_id)->paginate(5);

        return redirect(route('jobseeker.campaigns.show',$campaign_id));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($campaign_id, Job $job)
    {
          
        $job = Job::where('id',$job->id)->first();
        
        return view('jobseeker.jobs.show', ['job'=> $job, 'campaign' => $campaign_id]);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($campaign_id, Job $job)
    {
    
        return view('jobseeker.jobs.edit',['job' => $job, 'campaign' => $campaign_id, 'job_categories' => JobCategory::all()]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update($campaign_id, Request $request, Job $job)
    {
        $job->update($request->except(['_token']));
        $job->job_categories()->sync($request->job_category);
        $request ->session()->flash('success','You have edited the job');
        $job = Job::where('id',$job->id)->first();
        
        return redirect(route('jobseeker.campaigns.jobs.show',[$campaign_id,$job->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
