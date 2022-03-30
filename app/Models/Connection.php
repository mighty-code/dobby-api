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

    public function leaveInMinutes(): ?float
    {
        $nextConnection = $this->timetableEntries()->first();
        if (! $nextConnection) {
            return null;
        }

        $departure = $nextConnection->departure_at;
        $leaveAt = $departure->clone()->subMinutes($this->time_to_station)->timestamp;
        $diff = ($leaveAt - Carbon::now()->timestamp) / 60;

        return floor($diff);
    }

    public function newEloquentBuilder($query): SpatialBuilder
    {
        return new SpatialBuilder($query);
    }
}
