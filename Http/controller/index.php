<?php

use Core\Database;

$config = require base_path('config.php');

$db = new Database($config['database']);
$recipes = $db->query("select * from recipes LIMIT 3")->get();


require view('home.php');