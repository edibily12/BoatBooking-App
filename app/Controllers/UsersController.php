<?php

namespace App\Controllers;

use App\Models\User;

class UsersController
{
    public static function index()
    {
        return User::all();
    }

    public static function create($request)
    {

    }
    public static function show($id)
    {

    }


}