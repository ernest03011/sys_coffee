<?php

require base_path('Database.php');
$config = require base_path('config.php');
require base_path('Validator.php');

// $currentUserId = 2;
$user_id = getCurrentUserId();

$db = new Database($config['database']);
$recipe = $db->query("select * from recipes where recipe_id = :recipe_id", [
  'recipe_id' => $_POST['id']
])->findOrFail();
  
// Validate if the recipe was added by current user ID. 

if($recipe['user_id'] !== $user_id){
  // redirect the user
  header('location: /recipes');
  die();

}
   
$errors = [];

if(!Validator::string($_POST['title'])){
  $errors['title'] = 'A Title is required';
}
if(!Validator::string($_POST['description'])){
  $errors['description'] = 'The description is required';
}
if(!Validator::string( $_POST['ingredients'])){
  $errors['ingredients'] = 'The ingredients are required';
}
if(!Validator::string($_POST['instructions'])){
  $errors['instructions'] = 'The instructions are required';
}

if(! empty($errors)){
  
  return view('recipes/edit.view.php', [
    'errors' => $errors,
    'recipe' => $recipe
]);
}


$statement = $db->query('UPDATE recipes SET title = :title, instructions = :instructions, ingredients = :ingredients, description = :description WHERE recipe_id = :id AND user_id = :user_id', [
  'id' => $_POST['id'],
  'instructions' => $_POST['instructions'],
  'ingredients' => $_POST['ingredients'],
  'description' => $_POST['description'],
  'title' => $_POST['title'],
  'user_id' => $recipe['user_id']
]);


// redirect the user
header('location: /recipes');
die();


