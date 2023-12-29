<?php

if (!class_exists('Database')) {
  // If not, require it
  require base_path('Database.php');
}
$config = require base_path('config.php');

$db = new Database($config['database']);
$recipe = $db->query("select * from recipes where recipe_id = :recipe_id", [
  'recipe_id' => $_GET['id']
])->findOrFail();

require view('recipes/edit.view.php', [
  'recipe' => $recipe
]);