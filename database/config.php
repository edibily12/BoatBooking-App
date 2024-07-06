<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Pagination\Paginator;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'sqlite',
    'database' => __DIR__ . '/database.sqlite',
//    'host' => 'localhost',
//    'username' => 'root',
//    'password' => 'password',
//    'charset' => 'utf8',
//    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

Paginator::useBootstrap();
Paginator::useTailwind();
