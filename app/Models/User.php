<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
/** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'city_id',
        'is_active',
    ];

    public function scopAvailable($query)
    {
        return $query->userprofile()->available();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'creator_by');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'creator_by');
    }

    public function isFreelancer()
    {
        return $this->role && $this->role->name === 'freelancer';
    }



    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

}
