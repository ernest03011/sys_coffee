<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>


<div class="mx-auto max-w-7xl py-6 px-4 sm:px-6 lg:px-8 bg-blue-700">
  <a href="/submit-recipe" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-blue-500 shadow-sm hover:text-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700">Add Recipe</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-center">

  <?php
        foreach ($recipes as $recipe) {
          echo "<div class='bg-white shadow-md rounded-md p-4'> <br/>";
            echo "<h3 class='text-xl font-semibold mb-2'>" . $recipe['title'] . "</h3>";
            echo "<p class='text-gray-600 mb-4'>" . $recipe['description'] . "</p>"; 
            echo "<p class='text-gray-600 mb-4'>" . $recipe['ingredients'] . "</p>"; 
            echo "<p class='text-gray-600 mb-4'>" . $recipe['instructions'] . "</p>"; 
            echo "<a href='/recipe?id=" . $recipe['recipe_id'] . "'>See more</a>";

            echo "</div>";
        }
      ?>

</div>

<?php require view('partials/footer.php'); ?>
