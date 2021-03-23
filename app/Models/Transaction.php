<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['payment_id', 'payment_method', 'amount', 'currency', 'status'];

    public function orders(){
        return $this->belongsToMany(Order::class);
    }

    public function order(){
        return $this->orders()->first();
    }
}
