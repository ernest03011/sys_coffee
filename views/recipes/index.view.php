<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>


<div class="py-8 text-center px-10 sm:px-6 lg:px-12 lg:py-10 bg-yellow-950">
  <a href="/submit-recipe" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-saddle-brown shadow-sm hover:orange-950 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-950">Add Recipe</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-center">

  <?php 
        foreach ($recipes as $recipe) {
          echo "<div class='bg-white shadow-md rounded-md p-4 border-l-4 border-orange-900 mt-4'> <br/>";
            echo "<h3 class='text-xl font-semibold mb-2'>" . $recipe['title'] . "</h3>";
            echo "<p class='text-gray-600 mb-4'>" . $recipe['description'] . "</p>"; 
            echo "<p class='text-gray-600 mb-4'>" . $recipe['ingredients'] . "</p>"; 
            echo "<p class='text-gray-600 mb-4'>" . $recipe['instructions'] . "</p>"; 
            echo "<a href='/recipe?id=" . $recipe['recipe_id'] . "'>See more</a>";

        
            if($recipe['is_premium'] == 1){
              echo "<p class='text-yellow-950'>It is premium</p>";
            }

            echo "</div>";
        }
      ?>

</div>

<?php require view('partials/footer.php'); ?>
