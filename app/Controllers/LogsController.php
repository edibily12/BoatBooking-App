<?php

namespace App\Controllers;

use App\Models\Log;
use App\Services\Encryption;

class LogsController
{

    public static function index()
    {
        return Log::orderBy('id', 'desc')->get();
    }

    public static function create($action)
    {
        $action = Encryption::encrypt($action);
        Log::create([
            'user_id' => Auth::user()->id,
            'action' => $action,
            'ip_address' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
        ]);
    }

}