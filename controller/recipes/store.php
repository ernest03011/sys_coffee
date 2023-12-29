<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $config = require '../config.php';
    require '../Validator.php';

    $errors = [];

    $databaseSettings = $config['database'];
  
    $host = $databaseSettings['host'];
    $user = $databaseSettings['user'];
    $port = $databaseSettings['port'];
    $dbname = $databaseSettings['dbname'];
    $charset = $databaseSettings['charset'];
    $password = $databaseSettings['password'];
      // Retrieve form data
    $title = trim($_POST["title"]);
    $description = trim($_POST["description"]);
    $ingredients = trim($_POST["ingredients"]);
    $instructions = trim($_POST["instructions"]);
    // $user_id = 1;
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
      try {
          // Establish a PDO connection (replace with your database credentials)
          $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password;charset=$charset");

          // Set the PDO error mode to exception
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // Prepare the SQL statement
          $stmt = $pdo->prepare("INSERT INTO recipes (title, description, ingredients, instructions, user_id) VALUES (:title, :description, :ingredients, :instructions, :user_id)");

          // Bind parameters
          $stmt->bindParam(':title', htmlspecialchars($title));
          $stmt->bindParam(':description', htmlspecialchars($description));
          $stmt->bindParam(':ingredients', htmlspecialchars($ingredients));
          $stmt->bindParam(':instructions', htmlspecialchars($instructions));
          $stmt->bindParam(':user_id', $user_id);

          // Execute the statement
          $stmt->execute();

          // echo "Data inserted successfully!";
          redirect("/");
      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }

      // Close the connection
      $pdo = null;
    }
}
