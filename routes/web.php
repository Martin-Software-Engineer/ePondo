<?php

use Admin\UserController;
use Illuminate\Support\Facades\Route;
use JobSeeker\CampaignController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

//Admin Routes using Route Group
Route::prefix('admin')->name('admin.')->middleware(['auth','auth.is-Admin'])->group(function (){
    Route::resource('/users', UserController::class);
});

// Demo route to check if verif email, lets use this for accessing profile,
// before they can they need to verify email
Route::get('/MyProfile', function () {
    return view('myprofile');
})->middleware(['auth','verified']);

//JobSeeker -> Campaigns Route using Route Group
Route::prefix('jobseeker')->name('jobseeker.')->middleware(['auth','auth.is-JobSeeker'])->group(function (){
    Route::resource('/campaigns', CampaignController::class);
});

