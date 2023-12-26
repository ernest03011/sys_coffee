<?php

// Check if this user has any active membership. 

if (!class_exists('Database')) {
  // If not, require it
  require base_path('Database.php');
}

$config = require base_path('config.php');
$db = new Database($config['database']);


// working with JWT

$user_id = getCurrentUserId();


if(! isset($user_id)){

  require view('memberships/create.view.php', 
  [
    'error' => $_GET['message'] ?? ''
  ]); 

  exit();
}

// Original
$result = $db->query('select * from memberships where user_id = :user_id', [
  'user_id' => $user_id // ['user_id'] was removed while testing JWT
])->get();


if(count($result) == 0){

  require view('memberships/create.view.php', 
  [
    'error' => $_GET['message'] ?? ''
  ]); 

}

$data = $result[0];

require view('memberships/show.view.php', [
  'data' => $data
]);