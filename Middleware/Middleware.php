<?php

require base_path('Middleware/Guest.php');
require base_path('Middleware/Authenticated.php');

class Middleware{
  public const MAP = [
    'guest' => Guest::class,
    'auth' => Authenticated::class
  ];

  public static function resolve($key){
    if(!$key){
      return;
    }

    $middleware = static::MAP[$key] ?? false;

    if(!$middleware){
      throw new \Exception("No matching middleware found for key" . $key . " .");
    }

    (new $middleware)->handle();
  }

}