<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'action', 'ip_address', 'user_agent'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}