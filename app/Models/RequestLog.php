<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    protected $fillable = [
        'url',
        'method',
        'status_code',
        'duration',
        'user_id',
        'ip',
    ];
}
