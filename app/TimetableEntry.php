<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimetableEntry extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'json',
        'route' => 'array',
    ];
}
