<?php

use Core\Database;
use Http\controller\session\Manager;

$config = require base_path('config.php');

$recipe_id = htmlspecialchars($_POST['id']);
$user_id = Manager::getCurrentUserId();

$db = new Database($config['database']);

try {
  $recipe = $db->query("select * from recipes where recipe_id = :recipe_id", [
    'recipe_id' => $recipe_id 
  ])->find();

} catch (\Exception $e) {

  redirect("/recipe/edit/?id={$recipe_id}", [
    'message' => 'Unable to delete the recipe, try again!',
    'modifiers' => 'type=error&color=red'
  ]);
}


if($recipe['user_id'] != $user_id){

  redirect("/recipe/edit/?id={$recipe_id}", [
    'message' => 'Unable to delete the recipe, try again!',
    'modifiers' => 'type=error&color=red'
  ]);
}

try {

  $db->query('DELETE from recipes WHERE recipe_id = :recipe_id', [
    'recipe_id' => $recipe_id 
  ]);
  
  $recipes = $db->query("select * from recipes")->get();
        
  require view('recipes/index.view.php', [
    'recipes' => $recipes
  ]);

} catch (\Exception $e) {

  redirect("/recipe/edit/?id={$recipe_id}", [
    'message' => 'Unable to delete the recipe, try again!',
    'modifiers' => 'type=error&color=red'
  ]);
}

$db->killConnection();



