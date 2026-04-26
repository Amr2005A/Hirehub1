<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'project_id',
        'suggested_price',
        'user_id',
        'cover_letter',
        'count_of_days',
        'status',
        'file_path'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_by');
    }
}
