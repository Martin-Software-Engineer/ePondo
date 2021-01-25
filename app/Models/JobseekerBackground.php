<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobseekerBackground extends Model
{
    use HasFactory;

    // public function path(){

    //     return url ('/jobseeker/backgroundinformation/' . $this -> id);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fourpsdata()
    {
        return $this->hasOne(FourPsData::class);
    }

    public function kids()
    {
        return $this->hasOne(JobseekerKids::class);
    }

    public function dependents()
    {
        return $this->hasOne(JobseekerDependents::class);
    }
}
