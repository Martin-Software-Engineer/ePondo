<?php

namespace App\Http\Controllers\JobSeeker;

use App\Models\Job;
use App\Models\Role;
use App\Models\User;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Campaign;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\CampaignCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::paginate(10);
        // $roles = Role::all();
        // return view('admin.users.index',['users' => $users,'roles' => $roles]);

        $user_id = auth()->user()->id;

        $campaigns = Campaign::where('user_id',$user_id)->paginate(5);
        // $campaigns = $campaigns->
        // $campaigns = DB::select('select * from campaigns where user_id = ?', [$user_id]);
        
        
        // $path = Storage::disk('s3')->url('campaign/' . 'U0CWk2En5JpJh4feIOBhxDkFmUznhURDQrdhl9dk.jpeg');
        
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

        // $data =  Campaign::create([
            
        //     'title' => $data['title'],
        //     'description' => $data['description']
            
        // ]);

        $data = $request->validate([
            
            'title' => 'required',
            'description' => 'required',
            'campaign_category' => 'required',
            'images.*' => 'required'
            
        ]);

        $campaign = new Campaign();
        $campaign -> user_id = auth()->user()->id;
        $campaign -> title = $data['title'];
        $campaign -> description = $data['description'];
        $campaign -> save();

        // dd($data['images']['0']);

        // $path = Storage::disk('s3')->put('campaign',$data['images']);
        
        foreach($data['images'] as $image){
            
            $path = Storage::disk('s3')->put(
                'campaign', $image, 'public'
            );

            $photo = new Photo();
            $photo -> filename =  basename($path);
            $photo -> url = Storage::url($path);
            $photo -> save();
                
            $campaign->photos()->attach($photo->id);

        }
        
        
        // $path = Storage::disk('s3')->put(
        //     'campaign', $data['images']['0'], 'public'
        // );

        // dd($path);
        

        // Storage::disk('s3')->setVisibility($path, 'public');

        // $question -> answers()->createMany($data['answers']);

        // $image = Photo::create([
        //     'filename' => basename($path),
        //     'url' => Storage::url($path)
        // ]);



        // $photo = new Photo();
        // $photo -> filename =  basename($path);
        // $photo -> url = Storage::url($path);
        // $photo -> save();
       
        // $campaign->photos()->attach($photo->id);

        

        // $file = $request -> file('image');


        // $path = Storage::disk('s3')->put('campaign', $file);

        // $image = Photo::create([
        //     'filename' => basename($path),
        //     'url' => Storage::url($path)
        // ]);





        // dd($path);

        // $contents = Storage::get($file);

        // dd($contents);

        // $filename = $file->getClientOriginalName();
        // $filename = time(). '.' . $filename;
        // $path = $file->store('public',$file,'s3');
        
        
        // $image = $request->file('image');
        // dd($campaign);

        // $path = $request -> file ('image') -> store ('images','s3');
        // $path = $request -> file('image') -> store ('public/images');
        // $path = Storage::put($image);
        // return $path;
        // dd($data['image']);
        // $path = $data['image'] -> store ('public/images');
        

        // $jobs1 = new Job();
        // $jobs1->name = request('name');
        // $jobs1->save();

        // $data['user_id'] = auth()->user()->id;
        // Campaign::create($data);


        //Used when using the relationship of the users and questionnaires
        // $campaign = auth() -> user() -> campaigns() -> create($data);

        $campaign->campaign_categories()->attach($request['campaign_category']);
        $request ->session()->flash('success','You have created a campaign');

        // $campaign->campaign_categories()->sync($request->campaign_category);

        

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
    public function show(Campaign $campaign)
    {
        // use below if show($questionnaire)
        // $campaign = Campaign::findOrFail($id);
        // return view('jobseeker.campaigns.show',[ 'campaign' => $campaign]);
        

        // $questionnaire -> load ('questions.answers.responses');

        // return view('jobseeker.campaigns.show', compact('campaign'));
        
        $campaign_id = $campaign->id;
        $campaign_category = CampaignCategory::all();

        $jobs = Job::where('campaign_id',$campaign_id)->paginate(5);
        // $job_category = JobCategory::all();

        $products = Product::where('campaign_id',$campaign_id)->paginate(5);
        // $product_category = ProductCategory::all();

        // dd($products);


        //OUTPUT IMAGE FROM AWS S3
        
        // return Storage::disk('s3')->response('campaign/' . $image->filename);



        // return view('jobseeker.campaigns.show', compact('campaign'));
        return view('jobseeker.campaigns.show', 
                                                ['campaign' => $campaign, 'campaign_category'=> $campaign_category ,
                                                'jobs'=> $jobs, 'products' => $products ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $campaign = Campaign::find($id);
        return view('jobseeker.campaigns.edit',['campaign' => Campaign::find($id),'campaign_categories' => CampaignCategory::all()]); 
        // return route('jobseeker.campaigns.edit','$id');
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
        // dd($request);

        $campaign = Campaign::findOrFail($id);

        $campaign->update($request->except(['_token']));


        $campaign->campaign_categories()->sync($request->campaign_category);
        // $user->roles()->sync($request->roles);

        // $request ->session()->flash('success','You have edited the user');

        $request ->session()->flash('success','You have edited the campaign');

        return redirect(route('jobseeker.campaigns.show',$campaign->id));
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
