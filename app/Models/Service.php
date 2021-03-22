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

    protected $fillable = ['user_id','title','description', 'price', 'duration', 'location'];
    protected $appends = ['thumbnail', 'thumbnail_url'];
    
    public function jobseeker(){
        return $this->belongsTo(User::class, 'user_id', 'id');
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
    
    public function orders(){
        return $this->hasMany(Order::class, 'service_id', 'id')->with(['transactions']);
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
