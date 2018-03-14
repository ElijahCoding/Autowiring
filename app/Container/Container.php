<?php

namespace App\Container;

class Container
{
  protected $items = [];

  public function set($name, callable $closure)
  {
    $this->items[$name] = $closure;
  }

  public function has($name)
  {
    return isset($this->items[$name]);
  }

  public function get($name)
  {
    if (!$this->has($name)) {
      throw new NotFoundException;
    }
    return $this->items[$name]();
  }
}
