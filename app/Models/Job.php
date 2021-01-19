<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function publicpath(){

        return url ('/Jobs/' . $this -> id);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function job_categories(){
        return $this->belongsToMany(JobCategory::class);
    }

    public function photos(){
        return $this->belongsToMany(Photo::class);
    }
}