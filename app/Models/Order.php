<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'duration', 'location'];

    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'id')->with(['jobseeker']);
    }

    public function backer(){
        return $this->belongsTo(User::class, 'backer_id', 'id');
    }
}
