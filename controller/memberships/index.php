<?php

// Check if this user has any active membership. 

if (!class_exists('Database')) {
  // If not, require it
  require base_path('Database.php');
}
$config = require base_path('config.php');
$db = new Database($config['database']);

// $currentUserId = 3;

// $user_email = $_SESSION['user']['email'];

// $user = $db->query("select * from users where email = :email", [
//   'email' => $user_email
// ])->find();

// testing JWT

$user_id = getCurrentUserId();
// dd($user);

if(! isset($user)){

  require view('memberships/index.view.php', $user = [
    'has_membership' => false
  ]); 

  exit();
}

// Original
$result = $db->query('select * from memberships where user_id = :user_id', [
  'user_id' => $user_id // ['user_id'] was removed while testing JWT
])->get();

// Testing - 

// $result = $db->query('select * from memberships where user_id = :user_id', [
//   'user_id' => 9
// ])->get();


if(count($result) == 0){
  require view('memberships/index.view.php', $user = [
    'has_membership' => false
  ]); 

  exit();
}


require view('memberships/index.view.php', $user = [
  'has_membership' => true,
  'membership_data' => $result[0]
]);