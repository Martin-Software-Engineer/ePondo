<?php

namespace App\Http\Controllers\Backer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){
        return view('backer.contents.myaccount');
    }
}
