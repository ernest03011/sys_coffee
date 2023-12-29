<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!class_exists('Database')) {
      // If not, require it
      require base_path('Database.php');
    }
    
    $config = require base_path('config.php');
    $db = new Database($config['database']);
    require base_path('Validator.php');

    $errors = [];

    // Retrieve form data
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $ingredients = trim($_POST["ingredients"]);
    $instructions = trim($_POST["instructions"]);

    $user_id = getCurrentUserId();

    if(!Validator::string($title)){
      $errors['title'] = 'A Title is required';
    }
    if(!Validator::string($description)){
      $errors['description'] = 'The description is required';
    }
    if(!Validator::string($ingredients)){
      $errors['ingredients'] = 'The ingredients are required';
    }
    if(!Validator::string($instructions)){
      $errors['instructions'] = 'The instructions are required';
    }


    if(empty($errors)){
      $result = false;

      try {

        $db->query("INSERT INTO recipes (title, description, ingredients, instructions, user_id) VALUES (:title, :description, :ingredients, :instructions, :user_id)", [
          'title' => htmlspecialchars($title), 
          'description' => htmlspecialchars($description),
          'ingredients' => htmlspecialchars($ingredients), 
          'instructions' => htmlspecialchars($instructions),
          'user_id' => "asfas" // $user_id
        ]);
        
        // $result = true;
        require view("/recipes");

      } catch (Exception $e) {
        // $result = false;

        // I still need to work on passing the error message and redirecting. 
        redirect("/submit-recipe", [
          'message' => 'Unable to save the recipe!',
          'modifiers' => 'type=error&color=red'
        ]);
      }

      $db->killConnection();
    }
}