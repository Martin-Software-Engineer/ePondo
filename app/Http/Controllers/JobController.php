<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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


        return view ('jobseeker.jobs.create',compact('campaign_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($campaign_id, Request $request)
    {
        // dd($campaign_id);

        // $data = request() -> validate([
            
        //     'question.question' => 'required',
        //     'answers.*.answer' => 'required',
        // ]);

        // $question = $questionnaire->questions()->create($data['question']);
        // $question -> answers()->createMany($data['answers']);

        // return redirect('/questionnaires/'.$questionnaire -> id);

        $data = $request->validate([
            
            'title' => 'required',
            'description' => 'required'
        ]);

        $job = new Job();
        $job -> campaign_id = $campaign_id;
        $job -> title = $data['title'];
        $job -> description = $data['description'];
        $job -> save();

        // $campaign->campaign_categories()->attach($request['campaign_category']);
        $request ->session()->flash('success','You have created a New Job!');

        $campaign = Campaign::findOrFail($campaign_id);

        // return redirect(route('jobseeker.campaigns.index'));
        // return view('/jobseeker/campaigns/{campaign}/show');
        return view('jobseeker.campaigns.show', compact('campaign'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
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
