<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategoryParent extends Model
{
    use HasFactory;

    protected $table = "service_categories_parent";

    public function categories(){
        return $this->hasMany(ServiceCategory::class, 'parent_id', 'id');;
    }
}
