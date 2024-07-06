<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LockedAccount extends Model
{
    use SoftDeletes;
    protected $table = 'locked_accounts';
    protected $fillable = [
        'email'
    ];

}