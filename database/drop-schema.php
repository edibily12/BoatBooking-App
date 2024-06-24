<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Ensure this path is correct

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->dropAllTables();

echo "\nAll tables dropped successfully. ---------------------------------DONE\n\n";
