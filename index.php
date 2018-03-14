<?php
use App\Database\Database;

require_once __DIR__ . '/vendor/autoload.php';

$container = new App\Container\Container;

$container->share('config', function () {
  return new App\Config\Config;
});


$container->share('database', function ($container) {
    return new App\Database\Database($container->config);
});

dump($container->database->connect());
