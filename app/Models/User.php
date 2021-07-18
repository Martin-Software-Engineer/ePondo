<?php

namespace App\Models;

use App\Models\Campaign;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['earnings', 'orders', 'unreadmessages'];


    public function setPasswordAttributes($password){
        $this->attributes['password'] = Hash::make($password);
    }
    // ELOQUENT RELATIONSHIPS
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function rewards(){
        return $this->belongsToMany(Reward::class);
    }

    public function userinformation()
    {
        return $this->hasOne(UserInformation::class);
    }

    public function kids(){
        return $this->hasMany(UserKid::class, 'user_id', 'id');
    }

    public function dependents(){
        return $this->hasMany(UserDependent::class, 'user_id', 'id');
    }
    
    public function skills(){
        return $this->hasMany(UserSkill::class, 'user_id', 'id');
    }

    public function workexperiences(){
        return $this->hasMany(UserWorkExperience::class, 'user_id', 'id');
    }

    public function jobseekerbackground()
    {
        return $this->hasOne(JobseekerBackground::class);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
    }
    
    public function mycampaigns()
    {
        return $this->hasMany(Campaign::class, 'user_id', 'id')->with(['donations']);
    }

    public function services(){
        return $this->hasMany(Service::class, 'user_id', 'id')->with(['orders']);
    }
    
    public function donations(){
        return $this->belongsToMany(Donation::class);
    }

    public function information(){
        return $this->hasOne(UserInformation::class, 'user_id', 'id');
    }

    public function pppp(){
        return $this->hasOne(User4psInfo::class, 'user_id', 'id');
    }
    public function contacts(){
        return $this->hasMany(Contact::class, 'user_id', 'id')->with('info');
    }

    public function earnings(){
        return $this->hasMany(Earning::class, 'user_id', 'id');
    }

    public function messages(){
        return $this->hasMany(Message::class, 'to', 'id');
    }

    public function getEarningsAttribute(){
        $earnings = 0;
        $services =  $this->services()->whereHas('orders', function($q){
            $q->whereHas('transactions', function($q2){
                $q2->where('status', 'approved'); //paypal
            });
        })->get();

        foreach($services as $service){
            foreach($service['orders'] as $order){
                foreach($order['transactions'] as $transaction){
                    $earnings += $transaction->amount;
                }
            }
        }

        return $earnings;
    }

    public function getUnreadMessagesAttribute(){
        return $this->messages()->where('seen', 0)->count();
    }
    public function getOrdersAttribute(){
        return  $this->services()->get()->count();
    }


    // MIDDLEWARE PURPOSES
    /**
     * Check if user has a role
     * @param string $role
     * @return bool
     */
    public function hasAnyRole(string $role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
    /**
     * Check if user has any of the given role
     * @param array $role
     * @return bool
     */
    public function hasAnyRoles(array $role)
    {
        return null !== $this->roles()->whereIn('name', $role)->first();
    }
    
}
