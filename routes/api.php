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

Route::post('donation/paypal/create', 'DonatePaymentsController@CreatePayPalPayment')->name('api.donation_create_paypal');
Route::post('donation/paypal/execute', 'DonatePaymentsController@ExecutePaypalPayment')->name('api.donation_execute_paypal');
Route::post('donation/stripe/create', 'DonatePaymentsController@CreateStripePayment')->name('api.donation_create_stripe');
Route::post('donation/stripe/confirm', 'DonatePaymentsController@ConfirmStripePayment')->name('api.donation_confirm_stripe');

Route::post('order/paypal/create', 'OrderPaymentsController@CreatePayPalPayment')->name('api.order_create_paypal');
Route::post('order/paypal/execute', 'OrderPaymentsController@ExecutePaypalPayment')->name('api.order_execute_paypal');
Route::post('order/stripe/create', 'OrderPaymentsController@CreateStripePayment')->name('api.order_create_stripe');
Route::post('order/stripe/confirm', 'OrderPaymentsController@ConfirmStripePayment')->name('api.order_confirm_stripe');

