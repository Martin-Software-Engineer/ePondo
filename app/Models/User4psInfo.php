<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User4psInfo extends Model
{
    use HasFactory;

    protected $table = 'user_4ps_info';
    protected $fillable = ['user_id', 'id_photo', 'question1','question2','question3','question4'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photo(){
        return $this->hasOne(Photo::class, 'id', 'id_photo');
    }
}
