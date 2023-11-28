<?php

require base_path('Middleware/Middleware.php');
require base_path('Middleware/Authenticated.php');
require base_path('Middleware/Guest.php');

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

  public function route($uri, $method){

    foreach($this->routes as $route){
      if($route['uri'] === $uri && $route['method'] === strtoupper($method)){

        Middleware::resolve($route['middleware']);

        return require base_path($route['controller']);
      }
    }

    $this->abort();
  }

  protected function abort($code = 404){
    http_response_code($code);

    require "../views/{$code}.php";

    die();
  }

}