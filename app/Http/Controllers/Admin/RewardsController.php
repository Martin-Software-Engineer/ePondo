<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use App\Models\Role;
use App\Models\User;
use App\Helpers\System;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Rewards as ResourceRewards;

class RewardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Rewards';
        return view('admin.contents.rewards.index', $data);
    }

    /**
     * Show all records in json format.
     *
     * @return \Illuminate\Http\Response
     */
    public function data(){
        $role = Role::where('name', 'JobSeeker')->first();
        $results = User::whereHas('roles', function($q) use($role){
            $q->where('role_id', $role->id);
        })->get();

        return DataTables::of(ResourceRewards::collection($results))->toJson();
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
        $user = User::find($id,'id');
        $total_points = $user->rewards->sum('points');
        $data = [
            'title' => 'View Rewards History',
            'user' => $user->id,
            'name' => $user->userinformation->firstname.' '.$user->userinformation->lastname,
            'total' => $total_points,
            'reward_tier' => System::RewardsTier($total_points),
            'rewards' => $user->rewards,

        ];

        return view('admin.contents.rewards.show', $data);
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
