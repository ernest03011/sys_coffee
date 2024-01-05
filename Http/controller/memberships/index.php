<?php

use Core\Database;

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

$result = $db->query('select * from memberships where user_id = :user_id', [
  'user_id' => $user_id 
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