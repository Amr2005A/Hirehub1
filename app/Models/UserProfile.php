<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'personal_info',
        'hourly_price',
        'image',
        'phone_number',
        'availability_status',
        'portfolio_link',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function skills()
    {
        return $this->belongsToMany(Skill::class,'skill_user_profile')->withPivot('years_of_experience')->withTimestamps();
    }
}
