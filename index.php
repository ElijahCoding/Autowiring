<?php

use App\Config\Config;
use App\Database\Database;

require_once __DIR__ . '/vendor/autoload.php';

$container = new App\Container\Container;

$container->share(Database::class, function ($container) {
    return new App\Database\Database($container->get(Config::class));
});


dump((new App\Controllers\HomeController($container->get(Config::class), $container->get(Database::class)))->index());
