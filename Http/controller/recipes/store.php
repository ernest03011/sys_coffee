<?php

use Core\Database;
use Core\Validator;
use Http\controller\session\Manager;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $config = require base_path('config.php');
    $db = new Database($config['database']);

    $errors = [];

    // Retrieve form data
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $ingredients = trim($_POST["ingredients"]);
    $instructions = trim($_POST["instructions"]);

    $user_id = Manager::getCurrentUserId();

    if(!Validator::string($title))
    {
      $errors['title'] = 'A Title is required';
    }
    if(!Validator::string($description))
    {
      $errors['description'] = 'The description is required';
    }
    if(!Validator::string($ingredients))
    {
      $errors['ingredients'] = 'The ingredients are required';
    }
    if(!Validator::string($instructions))
    {
      $errors['instructions'] = 'The instructions are required';
    }

    $is_premium = $_POST['is-premium'] == 'true' ? 1 : 0;


    if(empty($errors)){
      $result = false;

      try {
        
        $db->query("INSERT INTO recipes (title, description, ingredients, instructions, user_id, is_premium) VALUES (:title, :description, :ingredients, :instructions, :user_id, :is_premium)", [
          'title' => htmlspecialchars($title), 
          'description' => htmlspecialchars($description),
          'ingredients' => htmlspecialchars($ingredients), 
          'instructions' => htmlspecialchars($instructions),
          'user_id' => $user_id, 
          'is_premium' => $is_premium
        ]);

        $recipes = $db->query("select * from recipes")->get();
        
        require view('recipes/index.view.php', [
          'recipes' => $recipes
        ]);

      } catch (Exception $e) {
        redirect("/submit-recipe", [
          'message' => 'Unable to save the recipe!',
          'modifiers' => 'type=error&color=red'
        ]);
      }

    }
    
    $db->killConnection();
}