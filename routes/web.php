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
Route::get('campaign/{id}/details','PagesController@campaign_details')->name('campaign_details');
Route::post('campaign/donate', 'CampaignsController@donate')->name('campaign.donate');

Route::get('services', 'PagesController@services')->name('services');
Route::get('service/{id}', 'PagesController@service_view')->name('service_view');
Route::get('service/{id}/details','PagesController@service_details')->name('service_details');
Route::post('service/avail', 'ServicesController@avail')->name('service.avail');

Route::get('aboutus', 'PagesController@aboutus')->name('aboutus');
Route::get('profile/{id}', 'PagesController@jobseeker')->name('profile');

//Admin Routes using Route Group
Route::prefix('admin')->name('admin.')->middleware(['auth','verified','auth.is-admin'])->group(function (){
    Route::get('/', 'Admin\CampaignsController@index')->name('index');

    Route::post('campaigns/{id}', 'Admin\CampaignsController@update')->name('campaigns.update');
    Route::post('campaigns/photos/update', 'Admin\CampaignsController@updatephotos')->name('campaigns.update-photos');
    Route::get('campaigns/{id}/delete', 'Admin\CampaignsController@destroy')->name('campaigns.destroy');
    Route::resource('campaigns', 'Admin\CampaignsController');

    Route::resource('donations', 'Admin\DonationsController');

    Route::post('services/{id}', 'Admin\ServicesController@update')->name('services.update');
    Route::post('services/photos/update', 'Admin\ServicesController@updatephotos')->name('services.update-photos');
    Route::get('services/{id}/delete', 'Admin\ServicesController@destroy')->name('services.destroy');
    Route::resource('services', 'Admin\ServicesController');

    Route::resource('service-orders', 'Admin\ServiceOrdersController');
    Route::resource('invoice', 'Admin\InvoicesController');
    Route::resource('ratings', 'Admin\RatingsController');
    Route::resource('rewards', 'Admin\RewardsController');

    Route::get('users/{id}/delete', 'Admin\UserManagementController@destroy')->name('users.destroy');
    Route::post('users/{id}', 'Admin\UserManagementController@update')->name('users.update');
    Route::resource('users', 'Admin\UserManagementController', ['except' => ['update', 'destroy']]);

    Route::get('jobseekers', 'Admin\JobseekerProfileController@index')->name('jobseekers.index');
    Route::get('jobseekers/{id}/edit','Admin\JobseekerProfileController@edit')->name('jobseekers.profile.edit');
    Route::post('jobseekers/{id}/update','Admin\JobseekerProfileController@update')->name('jobseekers.profile.update');

    Route::get('reports', 'Admin\ReportsController@index')->name('reports.index');

    Route::get('payouts', 'Admin\PayoutRequestsController@index')->name('payouts.index');
    Route::get('payouts/{id}', 'Admin\PayoutRequestsController@view')->name('payouts.view');
    Route::post('payouts/{id}/updatestatus', 'Admin\PayoutRequestsController@update_status')->name('payouts.updatestatus');
});

// Demo route to check if verif email, lets use this for accessing profile, before they can they need to verify email
Route::get('/MyProfile', function () { return view('myprofile'); })->middleware(['auth','verified']);

//JobSeeker -> Campaigns Route using Route Group
Route::prefix('jobseeker')->name('jobseeker.')->middleware(['auth','verified','auth.is-jobseeker'])->group(function (){
    Route::get('/', 'JobSeeker\AccountController@index')->name('index');
    Route::post('myaccount/update', 'JobSeeker\AccountController@update')->name('myaccount.update');
    Route::post('myaccount/changepassword', 'JobSeeker\AccountController@changepassword')->name('myaccount.changepassword');
    Route::get('profile','JobSeeker\JobseekerProfileController@index')->name('profile');
    Route::post('profile/update','JobSeeker\JobseekerProfileController@update')->name('profile.update');
    Route::get('orders', 'JobSeeker\OrdersController@index')->name('orders');
    Route::get('orders/{id}/show', 'JobSeeker\OrdersController@show')->name('orders.show');
    Route::get('orders/{id}/accept', 'JobSeeker\OrdersController@accept')->name('orders.accept');
    Route::get('orders/{id}/deliver', 'JobSeeker\OrdersController@deliver')->name('orders.deliver');
    Route::get('orders/{id}/decline', 'JobSeeker\OrdersController@decline')->name('orders.decline');
    Route::get('order-list', 'JobSeeker\OrdersController@data')->name('order-list');

    Route::get('invoices', 'JobSeeker\InvoicesController@index')->name('invoices');
    Route::get('invoice-list', 'JobSeeker\InvoicesController@data')->name('invoice-list');

    Route::get('rewards', 'JobSeeker\RewardsController@index')->name('rewards');

    Route::get('earnings', 'JobSeeker\EarningsController@index')->name('earnings');
    Route::post('withdraw', 'JobSeeker\EarningsController@withdraw')->name('earnings.withdraw');

    Route::resource('feedbacks', 'JobSeeker\FeedbacksController');
    Route::post('campaigns/{id}', 'JobSeeker\CampaignsController@update')->name('campaigns.update');
    Route::post('campaigns/photos/update', 'JobSeeker\CampaignsController@updatephotos')->name('campaigns.update-photos');
    Route::get('campaigns/{id}/delete', 'JobSeeker\CampaignsController@destroy')->name('campaigns.delete');
    Route::resource('campaigns', 'JobSeeker\CampaignsController', ['except' => ['destroy', 'update']]);
    
    Route::post('services/{id}', 'JobSeeker\ServicesController@update')->name('services.update');
    Route::post('services/photos/update', 'JobSeeker\ServicesController@updatephotos')->name('services.update-photos');
    Route::get('services/{id}/delete', 'JobSeeker\ServicesController@destroy')->name('services.delete');
    Route::resource('services', 'JobSeeker\ServicesController', ['except' => ['destroy', 'update']]);

    Route::get('rewards', 'JobSeeker\RewardsController@index')->name('rewards');
});

Route::prefix('backer')->name('backer.')->middleware(['auth','verified','auth.is-backer'])->group(function (){
    Route::get('/', 'Backer\AccountController@index')->name('index');
    Route::post('myaccount/update', 'Backer\AccountController@update')->name('myaccount.update');
    Route::post('myaccount/changepassword', 'Backer\AccountController@changepassword')->name('myaccount.changepassword');
    Route::get('donations', 'Backer\DonationsController@index')->name('donations');
    Route::get('donations/data', 'Backer\DonationsController@data')->name('donations.data');

    Route::resource('feedbacks', 'Backer\FeedbacksController');

    Route::get('orders', 'Backer\OrdersController@index')->name('orders');
    Route::get('orders/data', 'Backer\OrdersController@data')->name('orders.data');
    Route::get('orders/{id}/edit', 'Backer\OrdersController@edit')->name('orders.edit');
    Route::get('orders/{id}/show', 'Backer\OrdersController@show')->name('orders.show');
    Route::get('orders/{id}/approve', 'Backer\OrdersController@approve')->name('orders.approve');
    Route::get('orders/{id}/invoice', 'Backer\OrdersController@invoice')->name('order.invoice');
    Route::post('orders/cancel', 'Backer\OrdersController@cancel')->name('orders.cancel');
});

Route::get('chats', 'ChatsController@index')->name('chats');
Route::get('get-messages/{id}', 'ChatsController@fetchMessages');
Route::get('get-chat-user/{id}', 'ChatsController@getUser');
Route::get('get-contacts', 'ChatsController@getContacts');

Route::post('messages', 'ChatsController@sendMessage');

Route::post('getChats', 'ChatsController@getChats');
Route::post('getConversation', 'ChatsController@getConversation');

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

Route::get('payment/success', function(){

})->name('payment.success');
Route::get('payment/cancel', function(){
    
})->name('payment.cancel');
