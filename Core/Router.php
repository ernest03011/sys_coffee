<?php

namespace Core;

use Core\Middleware\Middleware;

// require base_path('Middleware/Middleware.php');

class Router {

  protected $routes = [];

  public function add($method, $uri, $controller){

    $this ->routes[] = [
      'uri' => $uri,
      'controller' => $controller,
      'method' => $method,
      'middleware' => null
    ];

    return $this;

  }

  public function get($uri, $controller){
    
    return $this->add('GET', $uri, $controller);

  }

  public function post($uri, $controller){
    return $this->add('POST', $uri, $controller);
  }

  public function delete($uri, $controller){
    return $this->add('DELETE', $uri, $controller);

  }

  public function patch($uri, $controller){
    return $this->add('PATCH', $uri, $controller);
  }

  public function only($key){
    $this->routes[array_key_last($this->routes)]['middleware'] = $key;

    return $this;
  }

  public function route($uri, $method){

    foreach($this->routes as $route){
      if($route['uri'] === $uri && $route['method'] === strtoupper($method)){

        Middleware::resolve($route['middleware']);

        return require base_path("Http/controller/" . $route['controller']);
      }
    }

    $this->abort();
  }

  protected function abort($code = 404){
    http_response_code($code);

    // require "../views/{$code}.php";
    require view("{$code}.php");
    
    die();
  }

}

// Fatal error: Uncaught Error: Class "Core\Middleware\Middleware" not found in C:\Users\*\Core\Router.php:56 Stack trace: #0 C:\Users\*\public\index.php(15): Core\Router->route() #1 {main} thrown in C:\Users\*e\Core\Router.php on line 56