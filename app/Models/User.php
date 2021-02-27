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
        'name',
        'email',
        'password',
        'role_id',
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

    public function jobseekerbackground()
    {
        return $this->hasOne(JobseekerBackground::class);
    }

    public function campaigns()
    {
        return $this->belongsToMany(Campaign::class);
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
