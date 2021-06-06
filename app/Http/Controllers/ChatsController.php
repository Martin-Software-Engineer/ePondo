<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Contact;
use App\Models\User;
use App\Models\Conversation;
use App\Models\ConversationUser;
use App\Events\MessageSent;
use App\Http\Resources\Messages as MessageResource;
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
        return view('chat');
    }
    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages($user_id)
    {
        $messages = Message::with(['to', 'from'])->where(function($q) use($user_id){
                        $q->where('from', $user_id);
                        $q->where('to', auth()->user()->id);
                    })
                    ->orWhere(function($q) use($user_id){
                        $q->where('from', auth()->user()->id);
                        $q->where('to', $user_id);
                    })
                    ->get();

        return $messages;
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
        $from = Auth::user();
        $message = $from->messages()->create([
            'to' => $request->to,
            'message' => $request->input('message')
        ]);
        
        $isExists = Contact::where('user_id', $request->to)->where('contact_id', $from->id)->exists();
        if(!$isExists){
            Contact::create([
                'user_id' => $request->to,
                'contact_id' => $from->id
            ]);
        }

        broadcast(new MessageSent($message));
      
        return ['status' => 'Message Sent!'];
    }

    public function getContacts(){
        $user =  User::with('contacts')->where('id', auth()->user()->id)->first();
        return $user->contacts;
    }

    public function getChats(){
        $chats = Message::join('users',  function ($join) {
            $join->on('messages.from', '=', 'users.id')
                ->orOn('messages.to', '=', 'users.id');
        })
            ->where('messages.from', Auth::user()->id)
            ->orWhere('messages.to', Auth::user()->id)
            ->orderBy('messages.created_at', 'desc')
            ->get()
            ->unique('id');
        return $chats;
    }
}
