<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month);
    }

    public function scopeMaxBudget($query, $value)
    {
        return $query->where('fixed_price', '>=', $value)->where('budget_type','fixed');
    }

    public function scopeMinBudget($query, $value)
    {
        return $query->where('fixed_price', '>=', $value)->where('budget_type','fixed');
    }

    protected $fillable = [
        'user_id', 'title', 'description', 'budget_type', 'hourly_price', 'fixed_price', 'date', 'status', 'file_path'
    ];

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }

    public function creatorby()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
