<?php

require_once __DIR__ . '/vendor/autoload.php';

$container = new App\Container\Container;

$container->set('config', function () {
  return new App\Config\Config;
});

dump($container->config);
