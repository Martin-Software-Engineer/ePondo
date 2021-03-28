<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Contact;
use App\Models\User;
use App\Events\MessageSent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }

    /**
     * Show chats
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('chat');
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
          'message' => $request->input('message')
        ]);
      
        broadcast(new MessageSent($user, $message))->toOthers();
      
        return ['status' => 'Message Sent!'];
    }

    public function getContacts(){
        $user =  User::with('contacts')->where('id', auth()->user()->id)->first();
        return $user->contacts;
    }

    public function getChats(){
        $chats = Message::join('users',  function ($join) {
            $join->on('messages.from_id', '=', 'users.id')
                ->orOn('messages.to_id', '=', 'users.id');
        })
            ->where('messages.from_id', Auth::user()->id)
            ->orWhere('messages.to_id', Auth::user()->id)
            ->orderBy('messages.created_at', 'desc')
            ->get()
            ->unique('id');
        return $chats;
    }
}
