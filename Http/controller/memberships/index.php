<?php

use Core\Database;

// Check if this user has any active membership. 

// if (!class_exists('Database')) {
//   // If not, require it
//   require base_path('Database.php');
// }

// AUTLOADING AND DEPENDENCY MANAGER
$config = require base_path('config.php');
$db = new Database($config['database']);

// working with JWT
$user_id = getCurrentUserId();

if(! isset($user_id)){
  // CREATE FUNCTION TO RENDER CREATE VIEW
  require view('memberships/create.view.php', 
  [
    'error' => $_GET['message'] ?? ''
  ]); 

  exit();
}

// ADD ANOTHER CHECK TO CONFIRM IF IT IS ACTIVE AS WELL.
$result = $db->query('select * from memberships where user_id = :user_id', [
  'user_id' => $user_id 
])->get();


if(count($result) == 0){
  // CREATE FUNCTION TO RENDER CREATE VIEW
  require view('memberships/create.view.php', 
  [
    // VALIDATE AND SANITIZE THIS DATA
    'error' => $_GET['message'] ?? ''
  ]); 

}

$data = $result[0];

require view('memberships/show.view.php', [
  'data' => $data
]);