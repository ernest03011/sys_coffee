<?php

use Http\controller\session\Manager;
use Http\controller\rating\RecipeRating;

$user_id = Manager::getCurrentUserId();



$rating_value = $_POST['rating_value'];
$recipe_id = $_POST['id'];

$rating = RecipeRating::saveToDatabase($attributes = [
    'recipe_id' => $recipe_id,
    'user_id' => $user_id,
    'rating' => $rating_value,
]);


$url = getPrevUrl();
if (!$rating) {

    $errorMsg = 'Unable to reate this recipe';
    
    redirect($url, [
        'message' => urlencode($errorMsg),
        'modifiers' => 'type=error&color=red',
    ]);
}

$errorMsg = 'Great, you have rated this recipe!';


redirect($url, [
    'message' => urlencode($errorMsg),
    'modifiers' => 'type=error&color=green',
]);
