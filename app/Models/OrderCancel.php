<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCancel extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'reason'];
}
