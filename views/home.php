<?php

use Http\controller\session\Manager;
use Http\controller\rating\RecipeRating;

 require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>

  <main class="mt-4">
    
    <div class="container mx-auto my-20 p-4">
      
      <!-- Featured Recipe -->
      <section class="mb-8 mt-8">
          <h2 class="mb-4 text-center subtitle1">Featured Recipe</h2>

          <!-- Featured Recipe Cards --> 
  
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-center">
    
              <?php
                  foreach ($recipes as $recipe) {
                      echo "<div class='bg-white shadow-md rounded-md p-4 border-l-4 border-orange-900'> <br/>";
                      echo "<h3 class='text-xl font-semibold mb-2'>" . $recipe['title'] . "</h3>";
                      echo "<p class='text-gray-600 mb-4'>" . $recipe['description'] . "</p>"; 
                      echo "<p class='text-gray-600 mb-4'>" . $recipe['ingredients'] . "</p>"; 
                      echo "<p class='text-gray-600 mb-4'>" . $recipe['instructions'] . "</p>"; 
    
                      echo "</div>";
                  }
              ?>
    
          </div>

          <div class="m-8">
              <?php if(isset($_SESSION['user']['email'])) : ?>  
                <a href="/recipes" class="font-semibold text-yellow-950"><span class="" aria-hidden="true"></span>View all recipes <span aria-hidden="true">&rarr;</span></a>
              <?php endif; ?>
          </div>

      </section>

      <!-- Testimonials -->
      <section class="mb-8">
          <h2 class="subtitle1 mb-4 text-center">What Our Users Say</h2>
  
          <!-- Testimonial Cards -->
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ">
              <!-- Testimonial Card 1 -->
              <div class="bg-white shadow-md rounded-md p-4 border-l-4 border-orange-900">
                  <p class="text-gray-600 mb-4">"The best coffee recipes I've ever found! I love this platform."</p>
                  <span class="font-semibold">- CoffeeLover123</span>
              </div>
  
              <!-- Testimonial Card 2 -->
              <div class="bg-white shadow-md rounded-md p-4 border-l-4 border-orange-900">
                  <p class="text-gray-600 mb-4">"The iced caramel latte is now my go-to drink. Amazing recipes!"</p>
                  <span class="font-semibold">- CaffeineQueen</span>
              </div>
  
              <!-- Testimonial Card 3 -->
              <div class="bg-white shadow-md rounded-md p-4 border-l-4 border-orange-900">
                  <p class="text-gray-600 mb-4">"This website has made my coffee brewing experience so much better."</p>
                  <span class="font-semibold">- BrewMaster</span>
              </div>
          </div>
      </section>
  
      <!-- Ratings (Visible after login) -->
      <!-- @auth -->
      <?php if(isset($_SESSION['user']['email'])) : ?>  
        <section>
            <h2 class="subtitle1 mb-4 text-center">Recipes Rated By You!</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" >

                <?php
        
                    $user_id = Manager::getCurrentUserId();
                    $recipes = RecipeRating::getAllRecipesRatedByUser($user_id);

                    // dd($recipes)
                    if(count($recipes) == 0){
                        echo "<p class='text-gray-600 mb-4'>You have NOT rated any recipes yet!</p>";
                    }

                    foreach ($recipes as $recipe) {
                        echo "<div class='bg-white shadow-md rounded-md p-4 border-l-4 border-orange-900'> <br/>";
                        echo "<p class='text-gray-600 mb-4'>Recipe: " . $recipe['recipe_name'] . "</h3>";
                        echo "<p class='text-gray-600 mb-4'>Rating: " . $recipe['rating'] . "</p>";
                        echo "</div>";
                    }
                ?>
            </div>
        </section>

      <!-- @endauth -->
      <?php endif; ?>
  
    </div>

  </main>

<?php require view('partials/footer.php'); ?>