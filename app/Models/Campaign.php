<?php

namespace App\Models;

use App\Models\Job;
use App\Models\User;
use App\Models\Product;
use App\Models\CampaignCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description'
    ];

    public function path(){

        return url ('/jobseeker/campaigns/' . $this -> id);
    }

    public function publicpath(){

        return url ('/Campaigns/' . $this -> id);
    }

    public function user(){
        return $this->belongsToMany(User::class);;
    }

    public function campaign_categories(){
        return $this->belongsToMany(CampaignCategory::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
