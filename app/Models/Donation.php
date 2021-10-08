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

    protected $appends = ['campaign', 'backer'];
    
    public function backer(){
        return $this->belongsToMany(User::class)->with('userinformation');
    }

    public function campaigns(){
        return $this->belongsToMany(Campaign::class);
    }

    public function getCampaignAttribute(){
        return $this->campaigns()->first();
    }

    public function getBackerAttribute(){
        return $this->backer()->first();
    }

    public function transactions(){
        return $this->belongsToMany(Transaction::class);
    }
}
