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

    protected $appends = ['campaign'];
    
    public function backer(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function campaigns(){
        return $this->belongsToMany(Campaign::class);
    }

    public function getCampaignAttribute(){
        return $this->campaigns()->first();
    }

    public function transactions(){
        return $this->belongsToMany(Transaction::class);
    }
}
