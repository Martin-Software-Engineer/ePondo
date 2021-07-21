<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\System;
use App\Models\ServiceRating;
use App\Http\Resources\RatingBacker as ResourceRatingBacker;
use App\Http\Resources\RatingJobseeker as ResourceRatingJobseeker;

use DataTables;
class RatingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Ratings & Feedbacks';
        return view('admin.contents.ratings.index', $data);
    }

    /**
     * Show all records in json format.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(Request $request){
        $results = ServiceRating::whereHas('order', function($q){
            $q->whereHas('service', function($q1){
                $q1->whereNull('deleted_at');
            });
        })->where('from', $request->from)->with('order')->get();

        switch($request->from){
            case 'backer': 
                return DataTables::of(ResourceRatingBacker::collection($results))->toJson();
            break;
            case 'jobseeker': 
                return DataTables::of(ResourceRatingJobseeker::collection($results))->toJson();
            break;
        }
        
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rating = ServiceRating::where('id',$id)->with('order')->first();
        $data['order_id'] = System::GenerateFormattedId('S', $rating->order_id);
        $data['rating'] = $rating;

        return view('admin.contents.ratings.show', $data);
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
