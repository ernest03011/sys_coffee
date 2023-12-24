<?php

if (!class_exists('Database')) {
  // If not, require it
  require base_path('Database.php');
}
$config = require base_path('config.php');

$db = new Database($config['database']);
$recipes = $db->query("select * from recipes")->get();

require view('recipes/index.view.php');