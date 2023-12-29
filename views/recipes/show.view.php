<?php require view('partials/head.php'); ?>

<?php require view('partials/nav.php'); ?>

<?php require view('partials/banner.php'); ?>


<div class="grid justify-center">

  <!-- The style for this h1 can be changed later, I copied it from the h3 below -->
  <div class="bg-gray-50 px-4 py-3 sm:px-6 flex gap-x-4 items-center">
    <h1 class="text-xl font-semibold mb-2 text-center"><?= $recipe['title'] ?></h1>
  </div>
  
  <div class="bg-gray-50 px-4 py-3 sm:px-6 flex gap-x-4 items-center">                       
    <p class="mb-6">
              <a href="/recipes" class="inline-flex justify-center rounded-md border border-transparent bg-gray-500 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">go back...</a> 
    </p>
  </div>

  <div>

    <div class="bg-gray-50 px-4 py-3 sm:px-6 flex gap-x-4 items-center">
      <h3 class='text-xl font-semibold mb-2'> <?= $recipe['title'] ?></h3> 
      <br>            
    </div>
    <div class="bg-gray-50 px-4 py-3 sm:px-6 flex justify-center flex-col">
      <p class='text-gray-600 mb-4'><?= $recipe['description']?> </p>
      <p class='text-gray-600 mb-4'><?= $recipe['ingredients'] ?></p> 
      <p class='text-gray-600 mb-4'><?= $recipe['instructions'] ?></p>    
    </div>

    <div class="">

      <?php
        
        
        if ($_GET['message'] ?? false) {
            // The message is not empty, proceed with displaying it
            // dd($_GET['message']);
            $message = urldecode($_GET['message']) ?? '';
            $type = $_GET['type'] ?? '';
            $color = $_GET['color'] ?? '';

            // Output the error message with the specified type and color
            echo '<div style="color: ' . $color . ';">' . htmlspecialchars($message) . '</div>';
            // dd($message);
        }
      ?>
           
      <?php
        require base_path('controller/rating/RecipeRating.php');
        $is_rated_by_this_user = RecipeRating::hasItBeenRated($_SESSION['user']['email'], $recipe['recipe_id']);

        if($is_rated_by_this_user){          
          echo "<p>You have rated this recipe with: " . $is_rated_by_this_user['rating'] . "</p>";
        }else{
          require view('partials/section.rating.php'); 
        }
        
      ?>

    </div>
    
    <div class="bg-gray-50 px-4 py-3 sm:px-6">
      <a href='/recipe/edit/?id=<?= $recipe['recipe_id'] ?>' class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Edit</a>                        
    </div>

  </div>

</div>

<?php require view('partials/footer.php'); ?>
