<?php

namespace App\Models;

use App\Models\Campaign;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function publicpath(){

        return url ('/Products/' . $this -> id);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function product_categories(){
        return $this->belongsToMany(ProductCategory::class);
    }
}
