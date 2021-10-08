<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'contact_id'];
    protected $appends = ['unreadmessages'];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function info(){
        return $this->belongsTo(User::class,'contact_id', 'id')->with('information');
    }

    public function messages(){
        return $this->hasMany(Message::class,'from','contact_id');
    }
    
    public function getUnreadMessagesAttribute(){
        return $this->messages()->where('to', $this->user_id)->where('seen', 0)->count();
    }

}
