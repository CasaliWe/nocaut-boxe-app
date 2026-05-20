<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$connection = $_ENV['DB_CONNECTION'] ?? 'sqlite';

if ($connection === 'mysql') {
    $capsule->addConnection([
        'driver'    => 'mysql',
        'host'      => $_ENV['DB_HOST'],
        'port'      => $_ENV['DB_PORT'],
        'database'  => $_ENV['DB_DATABASE'],
        'username'  => $_ENV['DB_USERNAME'],
        'password'  => $_ENV['DB_PASSWORD'],
        'charset'   => $_ENV['DB_CHARSET'],
        'collation' => $_ENV['DB_COLLATION'],
        'prefix'    => '',
    ]);
} else {
    $capsule->addConnection([
        'driver'   => 'sqlite',
        'database' => $_ENV['SQLITE_DATABASE'] ?? __DIR__ . '/../db/db.sqlite',
        'prefix'   => '',
    ]);
}

$capsule->setAsGlobal();
$capsule->bootEloquent();
