<?php

declare(strict_types=1);

namespace Core\Kernel;

class Router
{
  private static $routes = [];

  /**
   * Register a GET route.
   *
   * @param callable|array $handler Handler function or [Controller, method]
   */
  public static function get(string $path, callable|array $handler): self {
    self::addRoute('GET', $path, $handler);

    return new self();
  }

  /**
   * Register a POST route.
   *
   * @param string         $path
   * @param callable|array $handler Handler function or [Controller, method]
   */
  public static function post($path, $handler): self {
    self::addRoute('POST', $path, $handler);

    return new self();
  }

  private static function addRoute($method, $path, $handler) {
    self::$routes[$method][$path] = $handler;
  }

  public static function getRoutes(): array {
    return self::$routes;
  }
}
