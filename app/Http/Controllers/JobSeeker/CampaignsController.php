<?php

namespace App\Http\Controllers\JobSeeker;
use App\Models\Job;
use App\Models\Role;
use App\Models\User;
use App\Models\Photo;
use App\Models\Product;
use App\Models\Campaign;
use App\Models\JobCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\CampaignCategory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests\StoreCampaign;
use App\Http\Requests\UpdateCampaign;
use App\Notifications\CreateCampaign as CreateCampaignNotification;
use App\Mail\SendMail;
use App\Helpers\GiveReward;
use Image;
class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['campaigns'] = Campaign::where('user_id', auth()->user()->id)->get();
        $data['categories'] = CampaignCategory::all();
        //return response()->json($data);
        return view('jobseeker.contents.campaigns.index', $data);
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
        
        return view('jobseeker.contents.campaigns.create', $data);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCampaign $request)
    {
        $totalcampaigns = Campaign::where('user_id', auth()->user()->id)->count(); //Counter for Reward Points

        $campaign = Campaign::create([
            'user_id' => auth()->user()->id,
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

        Mail::to(auth()->user()->email)->queue(new SendMail('emails.jobseeker.campaign-mail', [
            'subject' => 'Successfully Created Campaign',
            'jobseeker_name' => auth()->user()->userinformation->firstname.' '.auth()->user()->userinformation->lastname,
            'campaign' => $campaign
        ]));
        
        auth()->user()->notify(new CreateCampaignNotification());
        
        //Reward Points
        if(!$totalcampaigns > 0){
            $reward = new GiveReward(auth()->user()->id, 'creating_1st_campaign');
            $reward->send();
        }else{
            $reward = new GiveReward(auth()->user()->id, 'creating_campaign');
            $reward->send();
        }
        return response()->json(array('success' => true, 'msg' => 'New Campaign Created.'));
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
        
        return view('jobseeker.campaigns.show',['campaign' => $campaign, 'campaign_category'=> $campaign_category ,'jobs'=> $jobs, 'products' => $products ]);
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
        //return $data;
        return view('jobseeker.contents.campaigns.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCampaign $request)
    {
        $campaign = Campaign::findOrFail($request->id);

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

        return response()->json(array('success' => true, 'msg' => 'Campaign Updated.'));
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
        if(Campaign::find($id)->delete()){
            return response()->json(['success' => true, 'msg' => 'Campaign Deleted.']);
        }
    }
}
