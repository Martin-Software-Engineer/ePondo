<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Contact;
use App\Models\User;
use App\Models\Conversation;
use App\Models\ConversationUser;
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
    public function index(Request $request)
    {
        return view('chat', ['conversation_id' => $request->id]);
    }
    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages($id)
    {
        $chat = Conversation::find($id);

        return $chat->messages;
    }

    public function getUser($id){
        return User::find($id);
    }

    public function getConversation(Request $request){

        $conversation = ConversationUser::whereIn('user_id', $request->users);
        $hasExist = $conversation->count() >= 2 ? true : false;

        if($hasExist){
            return Conversation::find($conversation->first()->conversation_id);
        }else{
            $newconvo = Conversation::create();
            foreach($request->users as $user){
                $newconvo->users()->create([
                    'user_id' => $user
                ]);
            }

            return $newconvo; 
        }
        
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
        $chat = Conversation::find($request->chat_id);
        $message = $chat->messages()->create([
            'user_id' => $user->id,
            'message' => $request->input('message')
        ]);
           
        broadcast(new MessageSent($message))->toOthers();
      
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
