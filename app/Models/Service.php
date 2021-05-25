<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id','title','description', 'price', 'duration_hours', 'duration_minutes', 'location'];
    protected $appends = ['thumbnail', 'thumbnail_url', 'ratings'];
    
    public function jobseeker(){
        return $this->belongsTo(User::class, 'user_id', 'id')->with('information');
    }

    public function categories(){
        return $this->belongsToMany(ServiceCategory::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function photos(){
        return $this->belongsToMany(Photo::class);
    }
    
    public function messages(){
        return $this->hasMany(ServiceMessage::class, 'service_id', 'id')->with('from');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'service_id', 'id')->with(['transactions']);
    }

    public function ratings(){
        return $this->hasMany(ServiceRating::class, 'service_id', 'id');
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

    public function getRatingsAttribute(){
        $total_ratings = $this->ratings()->sum('rating');
        $count_ratings = $this->ratings()->get()->count();

        return $count_ratings > 0 ? $total_ratings/$count_ratings : 0;
    }
}
