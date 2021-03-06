<?php

namespace App\Container;

use ReflectionClass;
use App\Container\Exceptions\NotFoundException;

class Container
{
  protected $items = [];

  public function set($name, callable $closure)
  {
    $this->items[$name] = $closure;
  }

  public function share($name, callable $closure)
  {
    $this->items[$name] = function () use ($closure) {
      static $resolved;

      if (!$resolved) {
        $resolved = $closure($this);
      }

      return $resolved;
    };
  }

  public function has($name)
  {
    return isset($this->items[$name]);
  }

  public function get($name)
  {
    if ($this->has($name)) {
      return $this->items[$name]($this);
    }

    return $this->autowire($name);
  }

  public function autowire($name)
  {
    if (!class_exists($name)) {
      throw new NotFoundException;
    }

    $reflector = $this->getReflector($name);

    dump($reflector);
    die();

    return new $name();
  }

  protected function getReflector($class)
  {
    return new ReflectionClass($class);
  }

  public function __get($name)
  {
    return $this->get($name);
  }
}
