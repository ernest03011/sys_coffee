<?php

    require 'functions.php';

    require 'Database.php';
  
    $db = new Database();
  
    $recipes = $db->query("select * from recipes")->fetchAll(PDO::FETCH_ASSOC);

    // dd($recipes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipes</title>

</head>
<body>


  <?php #require './views/header.php' ?>
  

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-center">

      <?php
        foreach ($recipes as $recipe) {
            echo "<div class='bg-white shadow-md rounded-md p-4'> <br/>";
            echo "<h3 class='text-xl font-semibold mb-2'>" . $recipe['title'] . "</h3>";
            echo "<p class='text-gray-600 mb-4'>" . $recipe['description'] . "</p>"; 
            echo "<p class='text-gray-600 mb-4'>" . $recipe['ingredients'] . "</p>"; 
            echo "<p class='text-gray-600 mb-4'>" . $recipe['instructions'] . "</p>"; 

            echo "</div>";
        }
      ?>

  </div>

  <?php #require './views/footer.php' ?>

</body>
</html>
  
