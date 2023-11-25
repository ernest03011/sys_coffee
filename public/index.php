<?php 

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'functions.php';
$router = require base_path('Router.php');
require base_path('routes.php');

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

// a hidden input should be added to the post 
// with the name _method and value DELETE or PATCH
// FORM can only use put and get request
 
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($url, $method);


