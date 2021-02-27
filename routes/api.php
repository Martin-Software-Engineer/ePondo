<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('campaigns', 'Admin\CampaignsController@data');
Route::get('donations', 'Admin\DonationsController@data');
Route::get('services', 'Admin\ServicesController@data');
Route::get('orders', 'Admin\ServiceOrdersController@data');
Route::get('invoices', 'Admin\InvoicesController@data');
Route::get('ratings', 'Admin\RatingsController@data');
Route::get('rewards', 'Admin\RewardsController@data');
Route::get('users', 'Admin\UserManagementController@data');
Route::get('jobseekers', 'Admin\JobseekerProfileController@data');
