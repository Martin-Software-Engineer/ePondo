<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDependent extends Model
{
    use HasFactory;

    protected $table = 'user_dependents';
    protected $fillable = ['user_id', 'fullname', 'age', 'relation'];
    
}
