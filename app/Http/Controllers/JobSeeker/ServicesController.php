<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\CampaignCategory;
use App\Models\Photo;
use App\Models\Tag;
use App\Models\User;

use App\Http\Requests\StoreService;
class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['services'] = Service::where('user_id', auth()->user()->id)->get();
        $data['service_categories'] = ServiceCategory::all();
        $data['campaign_categories'] = CampaignCategory::all();
        //return response()->json($data);
        return view('jobseeker.contents.services.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create Service';
        $data['categories'] = ServiceCategory::all();

        return view('jobseeker.contents.services.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreService $request)
    {
        $service = Service::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'duration' => $request->duration,
            'location' => $request->location
        ]);

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $upload = $request->file('thumbnail')->storeAs('/photos',$fileName,'public');
            $photo = new Photo();
            $photo ->filename =  $fileName;
            $photo ->url = 'public/photos/'.$fileName;
            $photo ->save();

            $service->thumbnail_id = $photo->id;
            $service->save();
        }
        
        if($request->input('category', [])){
            foreach($request->input('category', []) as $category){
                $service->categories()->attach($category);
            }
        }
        if($request->input('tags')){
            $tags = explode(',', $request->tags);
            foreach($tags as $tag){
                $tagStore = Tag::create(['name' => $tag]);
                $service->tags()->attach($tagStore->id);
            }
        }

        return response()->json(array('success' => true, 'msg' => 'New Service Created.'));
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
        $data['title'] = 'Edit Service';
        $data['service'] = Service::with(['jobseeker','categories','tags'])->where('id',$id)->first();

        return view('jobseeker.contents.services.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $service = Service::findOrFail($request->id);
        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->duration = $request->duration;
        $service->location = $request->location;
        $service->save();

        if($request->hasFile('thumbnail')){
            $image = $request->file('thumbnail');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $upload = $request->file('thumbnail')->storeAs('/photos',$fileName,'public');
            $photo = new Photo();
            $photo ->filename =  $fileName;
            $photo ->url = 'public/photos/'.$fileName;
            $photo ->save();

            $service->thumbnail_id = $photo->id;
            $service->save();
        }
        
        if($request->get('category', [])){
            $service->categories()->sync($request->get('category', []));
        }else{
            $service->categories()->detach();
        }

        if($request->input('tags')){
            $tags = explode(',', $request->tags);
            $service->tags()->detach();
            foreach($tags as $tag){
                $tagStore = Tag::create(['name' => $tag]);
                $service->tags()->attach($tagStore->id);
            }
        }else{
            $service->tags()->detach();
        }

        Mail::to(auth()->user()->email)->queue(new SendMail('emails.service-create-mail', [
            'subject' => 'Epondo Service'
        ]));

        return response()->json(array('success' => true, 'msg' => 'Service Updated.'));
    }

    public function updatephotos(Request $request){
        $service = Service::findOrFail($request->id);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $upload = $request->file('image')->storeAs('/photos',$fileName,'public');
            if($request->has('photo_id')){
                $photo = $service->photos()->where('photo_id', $request->photo_id)->first();
                $photo ->filename =  $fileName;
                $photo ->url = 'public/photos/'.$fileName;
                $photo ->save();
            }else{
                $photo = new Photo();
                $photo ->filename =  $fileName;
                $photo ->url = 'public/photos/'.$fileName;
                $photo ->save();

                $service->photos()->attach($photo->id);
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
        if(Service::find($id)->delete()){
            return response()->json(['success' => true, 'msg' => 'Campaign Deleted.']);
        }
    }
}
