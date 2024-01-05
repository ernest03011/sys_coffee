<?php 

const BASE_PATH = __DIR__ . '/../';

session_start();

require BASE_PATH . 'Core/functions.php';
require_once BASE_PATH . 'vendor/autoload.php';
$router = require base_path('Core/Router.php');
require base_path('routes.php');

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
 
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($url, $method);


