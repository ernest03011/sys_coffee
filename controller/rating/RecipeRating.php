<?php

class RecipeRating {
  // Properties

  private $recipe_id;
  private $user_id;
  private $rating;

  // Constructor
  public function __construct(public array $attributes) {

      $this->recipe_id = $attributes['recipe_id'];
      $this->user_id = $attributes['user_id'];
      $this->rating = $attributes['rating'];
  }

  // Getter methods

  public function getRecipeId() {
      return $this->recipe_id;
  }

  public function getUserId() {
      return $this->user_id;
  }

  public function getRating() {
      return $this->rating;
  }


  // Setter methods
  public function setRating($rating) {
      $this->rating = $rating;
  }

  // Save the rating to the database 
  public static function saveToDatabase($attributes) {

    $instance = new static($attributes);
    if (!class_exists('Database')) {
        // If not, require it
        require base_path('Database.php');
    }
    $config = require base_path('config.php');
    $db = new Database($config['database']);
    
    try {
        $db->query('Insert into ratings(recipe_id, user_id, rating) VALUES (:recipe_id, :user_id, :rating)', [
            'recipe_id' => $instance->getRecipeId(),
            'user_id' => $instance->getUserId(), 
            'rating' => $instance->getRating()
        ]);

        return true;

      } catch(Exception $e) {
        
        return false;
    }
    
  }

  public static function hasItBeenRated($user_email, $recipe_id){

    if (!class_exists('Database')) {
        // If not, require it
        require base_path('Database.php');
    }
    
    $config = require base_path('config.php');
    $db = new Database($config['database']);

    $user_id = getCurrentUserId();

    $ratings = $db->query("select * from ratings where user_id = :user_id AND recipe_id = :recipe_id ", [
        'recipe_id' => $recipe_id,
        'user_id' => $user_id  
    ])->find();

    return $ratings;

  }
}
