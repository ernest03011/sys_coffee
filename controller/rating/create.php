<?php

require base_path('controller/rating/RecipeRating.php');

$user_id = getCurrentUserId();

$rating_value = $_POST['rating_value'];
$recipe_id = $_POST['id'];

// if(!Validator::string($rating)){
//   $errors['username'] = 'The username is required';
// }
// if(!Validator::string($password, 8, 255)){
//   $errors['password'] = 'The password is required';
// }


// dd($recipe_id);

$rating = RecipeRating::saveToDatabase($attributes = [
  'recipe_id' => $recipe_id,
  'user_id' => $user_id, 
  'rating' => $rating_value
]);

// dd($rating);
$url = $_SERVER["HTTP_REFERER"];
if(! $rating){

  $errorMsg = 'Unable to reate this recipe';
  // $redirectUrl = $redirectUrl . '&message=' . urlencode($errorMsg) . '&type=error&color=red';
  
  // header('Location: ' . $redirectUrl);
  // exit();
  redirect($url, [
    'message' => urlencode($errorMsg),
    'modifiers' => 'type=error&color=red'
  ]);
}

$errorMsg = 'Great, you have rated this recipe!';
// $redirectUrl = $redirectUrl . '&message=' . urlencode($errorMsg) . '&type=error&color=green';

// header('Location: ' . $redirectUrl);
// exit();

redirect($url, [
  'message' => urlencode($errorMsg),
  'modifiers' => 'type=error&color=green'
]);