<?php

use Core\Database;
use Http\controller\session\Manager;
use Http\controller\memberships\MembershipManager;

$config = require base_path('config.php');
$db = new Database($config['database']);


$user_id = Manager::getCurrentUserId();

if(! isset($user_id)){

  require view('memberships/create.view.php', 
  [
    'error' => $_GET['message'] ?? ''
  ]); 

  exit();
}


$membershipManager = new MembershipManager($db);
$result = $membershipManager->hasAnActiveMembership($user_id);

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