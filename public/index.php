<?php 

const BASE_PATH = __DIR__ . '/../';

session_start();

require BASE_PATH . 'functions.php';
$router = require base_path('Router.php');
require base_path('routes.php');

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
 
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

$router->route($url, $method);


