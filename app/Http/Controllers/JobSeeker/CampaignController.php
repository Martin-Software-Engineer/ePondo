<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\User;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CampaignCategory;
use Illuminate\Support\Facades\Auth;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::all();
        return view ('jobseeker.campaigns.index',['campaigns' => $campaigns]);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jobseeker.campaigns.create',['campaign_categories' => CampaignCategory::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->validate([
            
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        // $campaign = Campaign::create($validatedData);

        // $jobs1 = new Job();
        // $jobs1->name = request('name');
        // $jobs1->save();

        //DB::insert('insert into jobs (name) values (?)', [request('name')]);
        // $question = $questionnaire->questions()->create($data['question']);
        // $question -> answers()->createMany($data['answers']);

        // $campaign = Campaign::create($data['title'],$data['description']);

        // $campaign = new Campaign();
        // $campaign -> user_id = Auth::id();
        // $campaign -> title = $data['title'];
        // $campaign -> description = $data['description'];

        $campaign =  Campaign::create([
            'user_id' => $request->user()->id,
            'title' => $data['title'],
            'description' => $data['description']
            
        ]);

        $campaign->campaign_categories()->attach($request['campaign_category']);

        // $campaign->campaign_categories()->sync($request->campaign_category);

        $request ->session()->flash('success','You have created a campaign');

        return redirect(route('jobseeker.campaigns.index'));

        //$validatedData = $request->validate([
        //     'name' => 'required|max:255',
        //     'email' => 'required|max:255|unique:users',
        //     'password' => 'required|min:8|max:255'
        // ]);
        // $user = User::create($validatedData);

        // $user->roles()->sync($request->roles);

        // $request ->session()->flash('success','You have created the user');

        // return redirect(route('admin.users.index'));
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
