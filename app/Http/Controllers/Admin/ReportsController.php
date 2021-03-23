<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\User;
use App\Models\Service;
use App\Models\Donation;
use App\Models\Order;
use App\Models\Transaction;

use Carbon\Carbon;
class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['statistics'] = (object)[
            'campaigns' => Campaign::all()->count(),
            'users' => User::all()->count(),
            'services' => Service::all()->count(),
            'donations' => Donation::whereHas('transactions', function($q){
                $q->orWhere('status', 'completed'); //paypal
                $q->orWhere('status', 'succeeded'); //stripe
            })->get()->sum('amount'),
            'orders' => Order::whereHas('transactions', function($q){
                $q->orWhere('status', 'completed'); //paypal
                $q->orWhere('status', 'succeeded'); //stripe
            })->get()->sum('amount'),
            'views' => 0
        ];

        $thismonth = Transaction::where(function($q){
            $q->orWhere('status', 'completed'); //paypal
            $q->orWhere('status', 'succeeded'); //stripe
        })->whereBetween('paid_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get()->sum('amount');

        $lastmonth = Transaction::where(function($q){
            $q->orWhere('status', 'completed'); //paypal
            $q->orWhere('status', 'succeeded'); //stripe
        })->whereBetween('paid_at', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->get()->sum('amount');

        $data['earnings'] = (object)[
            'thismonth' => $thismonth,
            'lastmonth' => $lastmonth,
            'difInPercent' => $lastmonth != 0 ? number_format((($thismonth-$lastmonth)/$lastmonth)*100) : $thismonth
        ];

        $topjobseekers = User::whereHas('roles', function($q){ $q->where('name', 'JobSeeker'); })->get();
        $topjobseekers = $topjobseekers->where('earnings', '!=', 0)->sortByDesc('earnings')->take(10);
        $data['topjobseekers'] = $topjobseekers;
        return view('admin.contents.reports.index', $data);
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
