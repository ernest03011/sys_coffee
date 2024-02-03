<?php

use Core\Database;
use Http\controller\session\Manager;
use Http\controller\memberships\MembershipManager;

$config = require base_path('config.php');
$db = new Database($config['database']);

// working with JWT
$user_id = Manager::getCurrentUserId();
// $user_id = 4; // getCurrentUserId();

if(! isset($user_id)){

  require view('memberships/create.view.php', 
  [
    'error' => $_GET['message'] ?? ''
  ]); 

  exit();
}
// does the user have a memebership?
// $result = $db->query('select * from memberships where user_id = :user_id', [
//   'user_id' => $user_id 
// ])->get();

$membershipManager = new MembershipManager($db);
$result = $membershipManager->hasAnActiveMembership($user_id);

// if(count($result) == 0){
if(! $result){

  require view('memberships/create.view.php', 
  [
    'error' => $_GET['message'] ?? ''
  ]); 

}

$data = $result[0];

require view('memberships/show.view.php', [
  'data' => $data
]);