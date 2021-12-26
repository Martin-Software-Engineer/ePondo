<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Helpers\System;
use App\Models\Donation;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Resources\Donations as ResourceDonation;

class DonationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Campaign Donations';
        return view('admin.contents.donations.index', $data);
    }

    /**
     * Show all records in json format.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(){
        $results = Donation::whereHas('transactions', function($q){
            $q->where('status', 'approved');
        })->with('backer')->get();
        
        return DataTables::of(ResourceDonation::collection($results))->toJson();
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
        $donation = Donation::where('id',$id)->with(['campaigns', 'backer'])->first();
        $data = [
            'title' => 'View Campaign Donation',
            'donation_id' => $donation->id,
            'donation_no' => System::GenerateFormattedId('CD', $donation->id),
            'donation_message' => $donation->message,
            'donation_amount' => $donation->amount,
            'donation_date' => date('F d, Y', strtotime($donation->created_at)),

            'backer_firstname' => $donation->backer->information->firstname,
            'backer_lastname' => $donation->backer->information->lastname,
            'backer_email' => $donation->backer->email,

            'campaigns' => $donation->campaigns
        ];

        return view('admin.contents.donations.show', $data);
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
