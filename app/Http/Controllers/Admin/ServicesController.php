<?php

namespace App\Http\Controllers\Admin;

use Image;
use DataTables;
use App\Models\Tag;
use App\Models\User;
use App\Models\Photo;
use App\Mail\SendMail;
use App\Helpers\System;
use App\Models\Service;
use App\Models\Region;
use App\Helpers\GiveReward;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\ServiceCategory;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\ServiceCategoryParent;
use App\Http\Resources\Service as ResourceService;
use App\Notifications\CreateService as CreateServiceNotification;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Services';
        return view('admin.contents.services.index', $data);
    }

    /**
     * Show all records in json format.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(){
        $results = Service::with('jobseeker')->get();
        return DataTables::of(ResourceService::collection($results))->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Create Service';
        $data['category_parents'] = ServiceCategoryParent::with('categories')->get();
        $data['jobseekers'] = User::whereHas('roles', function($q){
            $q->where('name', 'JobSeeker');
        })->get();
        $data['regions'] = Region::with('cities')->orderBy('name', 'asc')->get();
        
        return view('admin.contents.services.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobseeker = User::find($request->jobseeker_id);
        $totalservices = Service::where('user_id', $jobseeker->id)->count(); //Counter for Reward Points
        
        $service = Service::create([
            'user_id' => $request->jobseeker_id,
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'duration_hours' => $request->duration_hours,
            'duration_minutes' => $request->duration_minutes,
            'location' => $request->location
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

            $service->thumbnail_id = $photo->id;
            $service->save();
        }
        
        if($request->file('images',[])){
            foreach($request->file('images',[]) as $image){
                $fileName   = Str::random(3).time() . '.' . $image->getClientOriginalExtension();
                $upload = $image->storeAs('/photos',$fileName,'public');
                $photo = new Photo();
                $photo ->filename =  $fileName;
                $photo ->url = 'public/photos/'.$fileName;
                $photo ->save();

                $service->photos()->attach($photo->id);
            }
            
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

        $jobseeker->notify(new CreateServiceNotification());

        Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.service-create-mail', [
            'subject' => 'Successfully Created Service',
            'jobseeker_name' => $jobseeker->userinformation->firstname.' '.$jobseeker->userinformation->lastname,
            'service' => $service,
        ]));

        //Reward Points
        if(!$totalservices > 0){ //first time
            $reward = new GiveReward($jobseeker->id, 'creating_1st_service');
            $reward->send();
        }else{
            $reward = new GiveReward($jobseeker->id, 'creating_service');
            $reward->send();
        }

        return response()->json(['success' => true,'msg' => trans('admin.service.create.success')]);
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
        $data['service'] = Service::where('id', $id)->with(['categories', 'jobseeker', 'photos', 'tags'])->first();
        $data['category_parents'] = ServiceCategoryParent::with('categories')->get();
        $data['regions'] = Region::with('cities')->orderBy('name', 'asc')->get();
        
        return view('admin.contents.services.edit', $data);
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
        $service = Service::find($id);
        $service->user_id = $request->jobseeker_id;
        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->duration_hours = $request->duration_hours;
        $service->duration_minutes = $request->duration_minutes;
        $service->location = $request->location;
        $service->save();
        
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

        return response()->json(['success' => true,'msg' => trans('admin.service.update.success')]);
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
        $destroy = Service::find($id)->delete();
        if($destroy)
        return response()->json(array('success' => true, 'msg' => 'Service Deleted'));
    }
}
