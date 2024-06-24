<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'day', 'schedules_date', 'schedules_time', 'boat_id'
    ];

    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}