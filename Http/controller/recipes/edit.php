<?php

use Core\Database;

$config = require base_path('config.php');

$db = new Database($config['database']);
$recipe = $db->query("select * from recipes where recipe_id = :recipe_id", [
  'recipe_id' => $_GET['id']
])->findOrFail();

require view('recipes/edit.view.php', [
  'recipe' => $recipe
]);