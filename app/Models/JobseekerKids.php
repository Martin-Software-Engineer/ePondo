<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobseekerKids extends Model
{
    use HasFactory;

    public function jobseekerbackground()
    {
        return $this->belongsTo(JobseekerBackground::class);
    }
}
