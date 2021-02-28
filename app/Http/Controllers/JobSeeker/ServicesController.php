<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\CampaignCategory;
use App\Models\Photo;
use App\Models\Tag;

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
        return view('jobseeker.contents.services', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $service = Service::with(['jobseeker','categories','tags'])->where('id',$id)->first();
        return response()->json($service);
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

        return response()->json(array('success' => true, 'msg' => 'Service Updated.'));
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
