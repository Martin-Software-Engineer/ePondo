<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMessage extends Model
{
    use HasFactory;

    protected $fillable = ['service_id', 'user_id', 'message'];

    public function from(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}
