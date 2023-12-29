<?php

if (!class_exists('Database')) {
  // If not, require it
  require base_path('Database.php');
}
$config = require base_path('config.php');

// $currentUserId = 1;
$user_id = getCurrentUserId();

$db = new Database($config['database']);
$recipe = $db->query("select * from recipes where recipe_id = :recipe_id", [
  'recipe_id' => $_POST['id']
])->findOrFail();
  
// Validate if the recipe was added by current user ID. 

if($recipe['user_id'] !== $user_id){
  redirect("/recipes");
}

$db->query('DELETE from recipes WHERE recipe_id = :recipe_id', [
  'recipe_id' => $_POST['id']
]);

redirect("/recipes");


