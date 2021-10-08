<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
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
        'zipcode',
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

    protected $appends = ['age'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function useraddress()
    {
        return $this->hasOne(UserAddress::class);
    }

    public function getAgeAttribute(){
        return Carbon::parse($this->birthdate)->age;
    }
}
