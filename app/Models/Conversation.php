<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    public function messages(){
        return $this->hasMany(ConversationMessage::class,'conversation_id','id')->with('user');
    }

    public function users(){
        return $this->hasMany(ConversationUser::class, 'conversation_id', 'id');
    }
}
