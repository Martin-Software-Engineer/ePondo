<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRating extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','service_id', 'feedback', 'from', 'rating'];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id')->with(['service', 'backer']);
    }
}
