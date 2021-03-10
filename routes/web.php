<?php

use App\Mail\JobMail;
use App\Mail\WelcomeMail;
use App\Mail\CampaignMail;
use App\Mail\UserVerifyEmail;

use Admin\UserController;

use JobSeeker\JobseekerProfileController;
// use JobSeeker\JobController;
// use JobController;
use App\Http\Controllers;
// use App\Http\Controllers\JobseekerBackgroundController;

// use App\Models\JobseekerBackground;
// use PublicCampaignController;
use Illuminate\Support\Facades\Route;



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
Route::post('/register', 'Auth\RegisteredUserController@store');
Route::get('verify', 'Auth\RegisteredUserController@verify');
// PUBLIC PATHS
Route::get('/', 'PagesController@index');
Route::get('campaigns', 'PagesController@campaigns')->name('campaigns');
Route::get('campaign/{id}', 'PagesController@campaign_view')->name('campaign_view');
Route::get('campaign/{id}/details','PagesController@campaign_details')->name('camapaign_details');

Route::get('services', 'PagesController@services')->name('services');
Route::get('service/{id}', 'PagesController@service_view')->name('service_view');

Route::get('aboutus', 'PagesController@aboutus')->name('aboutus');
Route::get('profile/{id}', 'PagesController@jobseeker')->name('profile');

//Admin Routes using Route Group
Route::prefix('admin')->name('admin.')->middleware(['auth','verified','auth.is-admin'])->group(function (){
    Route::get('/', 'Admin\CampaignsController@index')->name('index');
    Route::resource('campaigns', 'Admin\CampaignsController');
    Route::resource('donations', 'Admin\DonationsController');
    Route::resource('services', 'Admin\ServicesController');
    Route::resource('service-orders', 'Admin\ServiceOrdersController');
    Route::resource('invoice', 'Admin\InvoicesController');
    Route::resource('ratings', 'Admin\RatingsController');
    Route::resource('rewards', 'Admin\RewardsController');
    Route::resource('users-management', 'Admin\UserManagementController');
    Route::resource('users', 'Admin\UserController');
    Route::get('jobseekers', 'Admin\JobseekerProfileController@index')->name('jobseekers.index');
});

// Demo route to check if verif email, lets use this for accessing profile, before they can they need to verify email
Route::get('/MyProfile', function () { return view('myprofile'); })->middleware(['auth','verified']);

//JobSeeker -> Campaigns Route using Route Group
Route::prefix('jobseeker')->name('jobseeker.')->middleware(['auth','verified','auth.is-jobseeker'])->group(function (){
    Route::get('/', 'JobSeeker\AccountController@index')->name('index');
    Route::get('profile','JobSeeker\JobseekerProfileController@index')->name('profile');
    Route::get('orders', 'JobSeeker\OrdersController@index')->name('orders');
    Route::get('order-list', 'JobSeeker\OrdersController@data')->name('order-list');

    Route::get('invoices', 'JobSeeker\InvoicesController@index')->name('invoices');
    Route::get('invoice-list', 'JobSeeker\InvoicesController@data')->name('invoice-list');

    Route::get('rewards', 'JobSeeker\RewardsController@index')->name('rewards');
    
    
    Route::resource('feedbacks', 'JobSeeker\FeedbacksController');
    Route::post('campaigns/update', 'JobSeeker\CampaignsController@update')->name('campaigns.update');
    Route::get('campaigns/{id}/delete', 'JobSeeker\CampaignsController@destroy')->name('campaigns.delete');
    Route::resource('campaigns', 'JobSeeker\CampaignsController', ['except' => ['destroy', 'update']]);
    
    Route::post('services/update', 'JobSeeker\ServicesController@update')->name('services.update');
    Route::get('services/{id}/delete', 'JobSeeker\ServicesController@destroy')->name('services.delete');
    Route::resource('services', 'JobSeeker\ServicesController', ['except' => ['destroy', 'update']]);

    Route::get('rewards', 'JobSeeker\RewardsController@index')->name('rewards');
});

Route::prefix('backer')->name('backer.')->middleware(['auth','verified','auth.is-backer'])->group(function (){
    Route::get('/', 'Backer\AccountController@index')->name('index');
    Route::get('donations', 'Backer\DonationsController@index')->name('donations');
    Route::get('donations/data', 'Backer\DonationsController@data')->name('donations.data');

    Route::get('orders', 'Backer\OrdersController@index')->name('orders');
    Route::get('orders/data', 'Backer\OrdersController@data')->name('orders.data');
    Route::get('orders/{id}/edit', 'Backer\OrdersController@edit')->name('orders.edit');
    Route::post('orders/cancel', 'Backer\OrdersController@cancel')->name('orders.cancel');
});

Route::get('chats', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');
Route::post('getContacts', 'ChatsController@getContacts');
Route::post('getChats', 'ChatsController@getChats');

// Mail Routes
Route::get('/email', function () { return new UserVerifyEmail(); });
Route::get('/welcome-mail', function () { return new WelcomeMail(); }); //create user email
Route::get('/campaign-mail', function () { return new CampaignMail(); }); //creating campaign email
Route::get('/job-mail', function () { return new JobMail(); }); //creating job email

// Front-End Coding
Route::get('/login-demo', function () { return view('/auth/login-demo'); });
Route::get('/register-demo', function () { return view('/auth/register-demo'); });
Route::get('/userreg-demo', function () { return view('/auth/userreg-demo'); });
Route::get('/homepage-demo', function () { return view('/auth/homepage-demo'); });
Route::get('/campaign-category', function () { return view('/public/campaigns/campaign-category'); });
Route::get('/campaign-home', function () { return view('/public/campaigns/campaign-home'); });
Route::get('/education-category', function () { return view('/public/patcampaigncategories/education-category'); });
Route::get('/medical-category', function () { return view('/public/patcampaigncategories/medical-category'); });
Route::get('/animals-category', function () { return view('/public/patcampaigncategories/animals-category'); });
Route::get('/nonprofit-category', function () { return view('/public/patcampaigncategories/nonprofit-category'); });
Route::get('/memorial-category', function () { return view('/public/patcampaigncategories/memorial-category'); });
Route::get('/emergencies-category', function () { return view('/public/patcampaigncategories/emergencies-category'); });
