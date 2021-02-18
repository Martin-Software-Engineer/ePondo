<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'message',
        'amount'
    ];

    public function backer(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
