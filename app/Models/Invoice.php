<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'add_charges', 'due_date'];

    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id')->with(['service', 'backer']);
    }
}
