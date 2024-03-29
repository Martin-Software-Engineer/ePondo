<?php

namespace App\Models;

use App\Models\Job;
use App\Models\User;
use App\Models\Product;
use App\Models\CampaignCategory;
use App\Models\Donation;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Campaign extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'target_amount',
        'target_date',
        'thumbnail_id'
    ];

    protected $appends = ['progress','thumbnail','thumbnail_url', 'raised', 'claimed', 'pending', 'available_funds'];

    public function path(){

        return url ('/jobseeker/campaigns/' . $this -> id);
    }

    public function publicpath(){

        return url ('/Campaigns/' . $this ->id);
    }

    public function jobseeker(){
        return $this->belongsTo(User::class, 'user_id', 'id')->with('information');
    }

    public function user(){
        return $this->belongsToMany(User::class);;
    }

    public function categories(){
        return $this->belongsToMany(CampaignCategory::class);
    }

    public function donations(){
        return $this->belongsToMany(Donation::class)->whereHas('transactions', function($q){
            $q->where('status', 'approved');
        });
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function photos(){
        return $this->belongsToMany(Photo::class);
    }

    public function claimed(){
        return $this->hasMany(ClaimedDonations::class);
    }
    public function getRaisedAttribute(){
        return $this->donations()->whereHas('transactions', function($q){
            $q->where('transactions.status', 'approved');
        })->sum('amount');
    }

    public function getClaimedAttribute(){
        return $this->claimed()->where('status', 'paid')->sum('amount');
    }

    public function getPendingAttribute(){
        return $this->claimed()->where('status', 'pending')->sum('amount');
    }

    public function getAvailableFundsAttribute(){
        $claimed = $this->claimed()->where('status', 'paid')->sum('amount');
        $pending = $this->claimed()->where('status', 'pending')->sum('amount');
        $raised = $this->donations()->whereHas('transactions', function($q){
            $q->where('transactions.status', 'approved');
        })->sum('amount');

        return $raised - ($claimed + $pending);
    }
    public function getProgressAttribute(){
        $donations = $this->donations()->whereHas('transactions', function($q){
            $q->where('transactions.status', 'approved');
        })->sum('amount');
        $target = $this->target_amount;

        $data = (object)array(
            'current_value' => number_format($donations),
            'target_value' => number_format($target),
            'percentage' => $donations > 0 ? ($donations / $target) * 100  : 0
        );

        return $data;
    }

    public function getThumbnailAttribute(){
        return Photo::find($this->thumbnail_id);
    }

    public function getThumbnailUrlAttribute(){
        $photo = Photo::find($this->thumbnail_id);
        $url = '../app-assets/images/pages/no-image.png';
        if($photo){
            $url = $photo->url;
            $url = Storage::url($url);
        }
        return $url;
    }
}
