<?php

use Illuminate\Support\Facades\Route;
use Admin\UserController;
use JobSeeker\CampaignController;

use App\Mail\UserVerifyEmail;
use App\Mail\WelcomeMail;
use App\Mail\CampaignMail;
use App\Mail\JobMail;


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

// PUBLIC PATHS
Route::get('/', function () {return view('public.index');});                        // HOME PAGE
Route::get('/Campaigns', function () { return view('public.campaigns.index'); });   // Campaigns
Route::get('/Jobs', function () { return view('public.jobs.index'); });             // Jobs
Route::get('/AboutUs', function () { return view('public.aboutus'); });     // About Us

//Admin Routes using Route Group
Route::prefix('admin')->name('admin.')->middleware(['auth','auth.is-Admin'])->group(function (){
    Route::resource('/users', UserController::class);
});

// Demo route to check if verif email, lets use this for accessing profile, before they can they need to verify email
Route::get('/MyProfile', function () { return view('myprofile'); })->middleware(['auth','verified']);

//JobSeeker -> Campaigns Route using Route Group
Route::prefix('jobseeker')->name('jobseeker.')->middleware(['auth','auth.is-JobSeeker'])->group(function (){
    Route::resource('/campaigns', CampaignController::class);
});

// Mail Routes
Route::get('/email', function () { return new UserVerifyEmail(); });
Route::get('/welcome-mail', function () { return new WelcomeMail(); }); //create user email
Route::get('/campaign-mail', function () { return new CampaignMail(); }); //creating campaign email
Route::get('/job-mail', function () { return new JobMail(); }); //creating job email

// Front-End Coding
Route::get('/login-demo', function () { return view('/auth/login-demo'); });
Route::get('/register-demo', function () { return view('/auth/register-demo'); });
