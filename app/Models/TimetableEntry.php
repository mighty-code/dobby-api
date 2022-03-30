<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimetableEntry extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'json',
        'route' => 'array',
        'arrival_at' => 'datetime',
        'departure_at' => 'datetime',
    ];
}
