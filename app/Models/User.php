<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'role_id', 'firstname', 'lastname', 'phone', 'email', 'code', 'password'
    ];

    protected $hidden = ['password'];

    //belongs to role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function locked()
    {
        return $this->hasOne(LockedAccount::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}