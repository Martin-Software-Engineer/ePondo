<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKid extends Model
{
    use HasFactory;

    protected $table = 'user_kids';

    protected $fillable = ['user_id', 'fullname', 'age'];
}
