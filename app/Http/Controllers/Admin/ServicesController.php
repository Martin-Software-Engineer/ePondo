<?php

namespace App\Http\Controllers\Admin;

use Image;
use DataTables;
use App\Models\Tag;
use App\Models\User;
use App\Models\Order;
use App\Models\Photo;
use App\Mail\SendMail;
use App\Models\Region;
use App\Helpers\System;
use App\Models\Service;
use App\Helpers\GiveReward;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\ServiceCategoryParent;
use App\Http\Resources\Service as ResourceService;
use App\Notifications\CreateService as CreateServiceNotification;
use App\Notifications\EditService as EditServiceNotification;
use App\Notifications\DeleteService as DeleteServiceNotification;

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
        $service = Service::where('id', $id)->with(['categories', 'jobseeker', 'tags'])->first();
        $order = Order::where('service_id', $id)->with(['details', 'backer'])->get();
        $data = [
            'title' => 'View Service',
            'service_id' => $service->id,
            'service_no' => System::GenerateFormattedId('S', $service->id),
            'service_title' => $service->title,
            'service_categories' => $service->categories,
            'service_desc' => $service->description,
            'service_price' => $service->price,
            'service_duration_hours' => $service->duration_hours,
            'service_duration_minutes' => $service->duration_minutes,
            'service_location' => $service->location,
            'service_tags' => $service->tags,
            'created_date' => date('F d, Y', strtotime($service->created_at)),
            'service_status' => $service->status,

            'user_id' => $service->jobseeker->id,
            'jobseeker_id' => System::GenerateFormattedId('J', $service->jobseeker->id),
            'jobseeker_username' => $service->jobseeker->username,
            'jobseeker_firstname' => $service->jobseeker->information->firstname,
            'jobseeker_lastname' => $service->jobseeker->information->lastname,
            'jobseeker_email' => $service->jobseeker->email,
            'jobseeker_contact' => $service->jobseeker->information->phone,

            'orders' => $order,
        ];

        return view('admin.contents.services.show', $data);
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
        $service->status = $request->status;
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

        $jobseeker = User::where('id',$service->user_id)->first();

        if($service->status == 2){
            Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.service-delete-mail', [
                'subject' => 'Service - Deleted',
                'jobseeker_name' => $jobseeker->userinformation->firstname.' '.$jobseeker->userinformation->lastname,
                'service' => $service
            ]));
            $jobseeker->notify(new DeleteServiceNotification($service));
        }
        else{
            Mail::to($jobseeker->email)->queue(new SendMail('emails.jobseeker.service-edit-mail', [
                'subject' => 'Service - Edited Successfully',
                'jobseeker_name' => $jobseeker->userinformation->firstname.' '.$jobseeker->userinformation->lastname,
                'service' => $service
            ]));
            $jobseeker->notify(new EditServiceNotification($service));
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
