<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReward extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','order_id', 'amount'];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id')->with(['service']);
    }
}
