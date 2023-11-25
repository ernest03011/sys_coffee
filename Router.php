<?php

class Router {

  protected $routes = [];

  public function get($url, $controller){
    $this ->routes[] = [
      'url' => $url,
      'controller' => $controller,
      'method' => 'GET'
    ];

  }

  public function post($url, $controller){
    $this ->routes[] = [
      'url' => $url,
      'controller' => $controller,
      'method' => 'POST'
    ];

  }

  public function delete($url, $controller){
    $this ->routes[] = [
      'url' => $url,
      'controller' => $controller,
      'method' => 'DELETE'
    ];
  }

  public function patch($url, $controller){
    $this ->routes[] = [
      'url' => $url,
      'controller' => $controller,
      'method' => 'PATCH'
    ];
  }

  public function route($url, $method){
    foreach($this->routes as $route){
      if($route['url'] == $url && $route['method'] == strtoupper($method)){
        return require $route['controller'];
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