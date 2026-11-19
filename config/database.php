<?php

use Illuminate\Support\Str;

return [

    'default' => 'mysql',

    'connections' => [

        'mysql' => [
            'driver' => 'mysql',
            'url' => null,
            'host' => '127.0.0.1',
            'port' => '3306',
            'database' => 'solar_crm',
            'username' => 'root',
            'password' => '',   // 👈 force empty password
            'unix_socket' => '',
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
        ],

    ],

    'migrations' => [
        'table' => 'migrations',
    ],

    'redis' => [

        'client' => 'phpredis',

        'options' => [
            'cluster' => 'redis',
            'prefix' => Str::slug('laravel').'-database-',
        ],

        'default' => [
            'url' => null,
            'host' => '127.0.0.1',
            'password' => null,
            'port' => '6379',
            'database' => '0',
        ],

        'cache' => [
            'url' => null,
            'host' => '127.0.0.1',
            'password' => null,
            'port' => '6379',
            'database' => '1',
        ],

    ],

];