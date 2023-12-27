<?php

require base_path('controller/rating/RecipeRating.php');

$user_id = getCurrentUserId();

$rating_value = $_POST['rating_value'];
$recipe_id = $_POST['id'];

$rating = RecipeRating::saveToDatabase($attributes = [
  'recipe_id' => $recipe_id,
  'user_id' => $user_id, 
  'rating' => $rating_value
]);

$redirectUrl = $_SERVER["HTTP_REFERER"];
if(! $rating){

  $errorMsg = 'Unable to insert the recipe';
  $redirectUrl = $redirectUrl . '&message=' . urlencode($errorMsg) . '&type=error&color=red';
  
  header('Location: ' . $redirectUrl);
  exit();
}

$errorMsg = 'Great, you have rated this recipe!';
$redirectUrl = $redirectUrl . '&message=' . urlencode($errorMsg) . '&type=error&color=green';

header('Location: ' . $redirectUrl);
exit();

