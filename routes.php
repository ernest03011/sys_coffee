<?php

$router = new Router();

$router->get('/', '/controller/index.php');
$router->get('/about', '/controller/about.php');
$router->get('/test', '/controller/test.php');

$router->get('/contact', '/controller/contact.php');
$router->post('/contact', '/controller/email/send.php');


$router->get('/login', '/controller/session/create.php')->only('guest');
$router->post('/login', '/controller/session/store.php')->only('guest');
$router->post('/logout', '/controller/session/destroy.php')->only('auth');

$router->get('/register', '/controller/registration/create.php')->only('guest');
$router->post('/register', '/controller/registration/store.php')->only('guest');

$router->get('/submit-recipe', '/controller/recipes/create.php')->only('auth');
$router->post('/submit-recipe', '/controller/recipes/store.php')->only('auth');

$router->get('/recipes', '/controller/recipes/index.php')->only('auth');
$router->get('/recipe', '/controller/recipes/show.php')->only('auth');
$router->delete('/recipe', '/controller/recipes/destroy.php')->only('auth');


$router->get('/recipe/edit/', '/controller/recipes/edit.php')->only('auth');
$router->patch('/recipe', '/controller/recipes/update.php')->only('auth');

$router->post('/rating', '/controller/rating/create.php')->only('auth');

$router->get('/membership', '/controller/memberships/index.php')->only('auth');
$router->post('/membership', '/controller/memberships/store.php')->only('auth');