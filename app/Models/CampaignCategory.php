<?php

namespace App\Models;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CampaignCategory extends Model
{
    use HasFactory;

    public function campaigns(){
        return $this->belongsToMany(Campaign::class);;
    }
}
