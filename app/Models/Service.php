<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','title', 'price', 'duration', 'location'];
    protected $appends = ['thumbnail'];

    public function jobseeker(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function categories(){
        return $this->belongsToMany(ServiceCategory::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function getThumbnailAttribute(){
        return Photo::find($this->thumbnail_id);
    }
}
