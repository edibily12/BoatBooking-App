<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boat extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name', 'description', 'capacity', 'image'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}