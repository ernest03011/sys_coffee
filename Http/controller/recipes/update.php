<?php

use Core\Database;
use Core\Validator;
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
    'message' => 'Unable to update the recipe, try again!',
    'modifiers' => 'type=error&color=red'
  ]);
}
   
$errors = [];

if(!Validator::string($_POST['title']))
{
  $errors['title'] = 'A Title is required';
}
if(!Validator::string($_POST['description']))
{
  $errors['description'] = 'The description is required';
}
if(!Validator::string( $_POST['ingredients']))
{
  $errors['ingredients'] = 'The ingredients are required';
}
if(!Validator::string($_POST['instructions']))
{
  $errors['instructions'] = 'The instructions are required';
}

if(! empty($errors)){
  
  redirect("/recipe/edit/?id={$recipe_id}", [
    'message' => 'Unable to update the recipe, try again!',
    'modifiers' => 'type=error&color=red'
  ]);
}

try {

  $db->query('UPDATE recipes SET title = :title, instructions = :instructions, ingredients = :ingredients, description = :description WHERE recipe_id = :id AND user_id = :user_id', [
    'id' => $_POST['id'],
    'instructions' => $_POST['instructions'],
    'ingredients' => $_POST['ingredients'],
    'description' => $_POST['description'],
    'title' => $_POST['title'],
    'user_id' => $recipe['user_id']
  ]);

  $recipes = $db->query("select * from recipes")->get();
        
  require view('recipes/index.view.php', [
    'recipes' => $recipes
  ]);

} catch (\Exception $e) {

  redirect("/recipe/edit/?id={$recipe_id}", [
    'message' => 'Unable to update the recipe, try again!',
    'modifiers' => 'type=error&color=red'
  ]);

}

$db->killConnection();
