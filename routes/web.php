<?php

use Illuminate\Support\Facades\Route;
use Admin\UserController;
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

Route::get('/', function () {
    return view('index');
});

Route::get('/email', function () {
    return new UserVerifyEmail()    ;
});

Route::get('/welcome-mail', function () { //create user email
    return new WelcomeMail();
});

Route::get('/campaign-mail', function () { //creating campaign email
    return new CampaignMail();
});

Route::get('/job-mail', function () { //creating job email
    return new JobMail();
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

