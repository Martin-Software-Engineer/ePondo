<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    protected $table = 'user_informations';
    
    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'middleinitial',
        'bio',
        'address',
        'phone',
        'birthdate',
        'age',
        'current_job',
        'employment_type',
        'freq_of_work',
        'main_source_income',
        'extra_source_income',
        'skills',
        'work_exp',
        'daily_income',
        'daily_expenses',
        'type_of_housing',
        'daily_meals',
        'water_access',
        'electricity_access',
        'clean_clothes_access',
        'has_kids',
        'has_dependents',
        'has_4ps',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function useraddress()
    {
        return $this->hasOne(UserAddress::class);
    }
}
