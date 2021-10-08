<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index(){
        $data['notifications'] = auth()->user()->notifications;

        return view('admin.contents.notifications', $data);
    }

    public function markall(){
        auth()->user()->unreadNotifications->markAsRead();

        return response()->json(['success' => true, 'msg' => 'All notifications mark as read.']);
    }
}
