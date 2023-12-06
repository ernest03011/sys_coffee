<?php

$router = new Router();

$router->get('/', '/controller/index.php');
$router->get('/recipes', '/controller/recipes.php');
$router->get('/about', '/controller/about.php');

$router->get('/login', '/controller/session/create.php')->only('guest');
$router->post('/login', '/controller/session/store.php')->only('guest');
$router->post('/logout', '/controller/session/destroy.php')->only('auth');

$router->get('/register', '/controller/registration/create.php')->only('guest');
$router->post('/register', '/controller/registration/store.php')->only('guest');

$router->get('/submit-recipe', '/controller/submit_recipe.php');
$router->get('/recipe', '/controller/recipe.php');



