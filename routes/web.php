<?php

use Illuminate\Support\Facades\Route;
use Admin\UserController;

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

// Route::get('/', function(){
//     dd(\Illuminate\Support\Facades\Auth::user());
// })->middleware(['auth','verified']);
