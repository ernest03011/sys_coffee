<?php

$router = new Router();

$router->get('/', '/controller/index.php');
$router->get('/recipes', '/controller/recipes.php');
$router->get('/about', '/controller/about.php');
$router->get('/login', '/controller/login.php')->only('guest');
$router->get('/register', '/controller/register.php');
$router->get('/submit-recipe', '/controller/submit_recipe.php');
$router->get('/recipe', '/controller/recipe.php');
// $router->get('/test', '../controller/testing.php');


