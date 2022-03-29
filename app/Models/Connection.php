<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\SpatialBuilder;

class Connection extends Model
{
    protected $guarded = ['user_id'];

    protected $casts = [
        'from_location' => Point::class,
        'to_location' => Point::class,
        'arrival_at' => 'datetime',
        'departure_at' => 'datetime',
    ];

    protected $with = [
        'timetableEntries',
    ];

    public function getDepartureAttribute($value)
    {
        return $value * 1000;
    }

    public function getArrivalAttribute($value)
    {
        return $value * 1000;
    }

    public function setFromAttribute($value)
    {
        $this->attributes['from'] = ucfirst($value);
    }

    public function setToAttribute($value)
    {
        $this->attributes['to'] = ucfirst($value);
    }

    public function setViaAttribute($value)
    {
        $this->attributes['via'] = ucfirst($value);
    }

    /**
     * Connections belongs to one user.
     */
    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function timetableEntries()
    {
        return $this->hasMany(TimetableEntry::class);
    }

    public function leaveInMinutes()
    {
        $nextConnection = $this->timetableEntries()->first();
        if (! $nextConnection) {
            return 0;
        }

        $departure = CarbonImmutable::createFromTimestamp($nextConnection->departure_at);
        $leaveAt = $departure->subMinutes($this->time_to_station)->timestamp;
        $diff = ($leaveAt - Carbon::now()->timestamp) / 60;

        return floor($diff);
    }

    public function newEloquentBuilder($query): SpatialBuilder
    {
        return new SpatialBuilder($query);
    }
}
