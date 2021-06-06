<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'contact_id'];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function info(){
        return $this->belongsTo(User::class,'contact_id', 'id');
    }

    public function messages(){
        return $this->hasMany(Message::class,'chat_id','id')->with('user');
    }
}
