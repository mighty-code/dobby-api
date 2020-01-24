<?php

namespace App;

use Carbon\Carbon;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    use SpatialTrait;

    protected $guarded = ['user_id'];

    protected $spatialFields = [
        'from_location',
        'to_location',
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
        $departure = Carbon::createFromTimestamp($this->departure / 1000);
        $leaveAt = $departure->clone()->subMinutes($this->time_to_station)->timestamp;
        $diff = ($leaveAt - Carbon::now()->timestamp) / 60;

        return floor($diff);
    }
}
