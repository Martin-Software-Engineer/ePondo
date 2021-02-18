<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'duration', 'location'];

    public function jobseeker(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categories(){
        return $this->belongsToMany(ServiceCategory::class);
    }
}
