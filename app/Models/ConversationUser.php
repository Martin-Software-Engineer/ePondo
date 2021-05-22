<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConversationUser extends Model
{
    use HasFactory;

    protected $fillable = ['conversation_id','user_id'];

    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }

    public function messages(){
        return $this->hasMany(ConversationMessage::class,'user_id','id');
    }
}
