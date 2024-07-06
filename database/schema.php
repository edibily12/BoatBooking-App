<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Models\Boat;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;


//roles table
if (!Capsule::schema()->hasTable('roles')) {
    Capsule::schema()->create('roles', function ($table) {
        $table->increments('id');
        $table->string('name');
        $table->softDeletes();
        $table->timestamps();
    });

    echo "Roles table created successfully. ---------------------------------DONE \n";
} else {
    echo "Roles table already exists.\n";
}

//users table
if (!Capsule::schema()->hasTable('users')) {
    Capsule::schema()->create('users', function ($table) {
        $table->increments('id');
        $table->string('firstname', 100);
        $table->string('lastname', 100);
        $table->foreignIdFor(Role::class)->constrained(); //1-admin, 2-mgr, 3-user
        $table->string('phone')->nullable();
        $table->string('email')->unique();
        $table->integer('code');
        $table->boolean('verified')->default(false);
        $table->string('password');
        $table->softDeletes();
        $table->timestamps();
    });

    echo "Users table created successfully. ---------------------------------DONE\n";
} else {
    echo "Users table already exists.\n";
}

//users logs
if (!Capsule::schema()->hasTable('logs')) {
    Capsule::schema()->create('logs', function ($table) {
        $table->increments('id');
        $table->foreignIdFor(User::class)->constrained();
        $table->string('action', 255);
        $table->string('ip_address', 45)->nullable();
        $table->string('user_agent', 255)->nullable();
        $table->softDeletes();
        $table->timestamps();
    });

    echo "Logs table created successfully. ---------------------------------DONE\n";
} else {
    echo "Logs table already exists.\n";
}

//locked accounts
if (!Capsule::schema()->hasTable('locked_accounts')) {
    Capsule::schema()->create('locked_accounts', function ($table) {
        $table->increments('id');
        $table->string('email')->nullable();
        $table->softDeletes();
        $table->timestamps();
    });

    echo "locked accounts table created successfully. ---------------------------------DONE\n";
} else {
    echo "locked accounts table already exists.\n";
}

//boats
if (!Capsule::schema()->hasTable('boats')) {
    Capsule::schema()->create('boats', function ($table) {
        $table->increments('id');
        $table->string('name', 100);
        $table->text('description')->nullable();
        $table->integer('capacity');
        $table->string('image', 255);
        $table->softDeletes();
        $table->timestamps();
    });

    echo "boats table created successfully. ---------------------------------DONE\n";
} else {
    echo "boats table already exists.\n";
}

//schedules
if (!Capsule::schema()->hasTable('schedules')) {
    Capsule::schema()->create('schedules', function ($table) {
        $table->increments('id');
        $table->date('day', 20);
        $table->foreignIdFor(Boat::class)->constrained();
        $table->date('schedules_date');
        $table->time('schedules_time');
        $table->softDeletes();
        $table->timestamps();
    });

    echo "schedules table created successfully. ---------------------------------DONE\n";
} else {
    echo "schedules table already exists.\n";
}

//booking
if (!Capsule::schema()->hasTable('bookings')) {
    Capsule::schema()->create('bookings', function ($table) {
        $table->increments('id');
        $table->foreignIdFor(User::class)->constrained();
        $table->foreignIdFor(Schedule::class)->constrained();
        $table->string('status', 50)->default('pending');
        $table->softDeletes();
        $table->timestamps();
    });

    echo "bookings table created successfully. ---------------------------------DONE\n";
} else {
    echo "bookings table already exists.\n";
}
