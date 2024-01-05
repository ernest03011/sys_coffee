<?php

use Core\Database;

$config = require base_path('config.php');

$db = new Database($config['database']);
$recipes = $db->query("select * from recipes")->get();

require view('recipes/index.view.php');