<?php

use Core\Database;
use Http\controller\session\Manager;
use Http\controller\memberships\MembershipManager;

$config = require base_path('config.php');

$db = new Database($config['database']);

$user_id = Manager::getCurrentUserId();

$membershipManager = new MembershipManager($db);
$result = $membershipManager->hasAnActiveMembership($user_id);

if(! empty($result)){
  $recipes = $db->query("select * from recipes")->get();
}else{
  $recipes = $db->query("select * from recipes where is_premium = 0")->get();
}

require view('recipes/index.view.php');