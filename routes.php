<?php

use Core\Router;

$router = new Router();

$router->get('/', '/index.php');
$router->get('/about', '/about.php');
$router->get('/test', '/test.php');

$router->get('/contact', '/contact.php');
$router->post('/contact', '/email/send.php');


$router->get('/login', '/session/create.php')->only('guest');
$router->post('/login', '/session/store.php')->only('guest');
$router->post('/logout', '/session/destroy.php')->only('auth');

$router->get('/register', '/registration/create.php')->only('guest');
$router->post('/register', '/registration/store.php')->only('guest');

$router->get('/submit-recipe', '/recipes/create.php')->only('auth');
$router->post('/submit-recipe', '/recipes/store.php')->only('auth');

$router->get('/recipes', '/recipes/index.php')->only('auth');
$router->get('/recipe', '/recipes/show.php')->only('auth');
$router->delete('/recipe', '/recipes/destroy.php')->only('auth');


$router->get('/recipe/edit/', '/recipes/edit.php')->only('auth');
$router->patch('/recipe', '/recipes/update.php')->only('auth');

$router->post('/rating', '/rating/create.php')->only('auth');

$router->get('/membership', '/memberships/index.php')->only('auth');
$router->post('/membership', '/memberships/store.php')->only('auth');

$router->get('/forgot-password', '/PasswordReset/index.php')->only('guest');
$router->post('/forgot-password', '/PasswordReset/create.php')->only('guest');

$router->get('/forgot-password/token/', '/PasswordReset/edit.php')->only('guest');
