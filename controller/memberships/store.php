<?php

if (!class_exists('Database')) {
  // If not, require it
  require base_path('Database.php');
}
$config = require base_path('config.php');
$db = new Database($config['database']);

// Testing JWT

$user_id = getCurrentUserId();

$billing_cycle = $_POST['billing_cycle'];

$result = false;

try {

  $db->query('Insert into memberships(user_id, subscription_duration, start_date, expiration_date) VALUES (:user_id, :subscription_duration, :start_date, :expiration_date)', [
    'user_id' => $user_id, // ['user_id'] was removed while testing JWT.
    'subscription_duration' => $billing_cycle, 
    'start_date' => $start_date->format('Y-m-d'), 
    'expiration_date' => $expiration_date
  ]);

  $result = true;

} catch (Exception $e) {

  $result = false;
}


if(! $result){
  $redirectUrl = $_SERVER["HTTP_REFERER"];
  $errorMsg = 'Unable to create the subscription, double-check the details and try again';
  $redirectUrl = $redirectUrl . '?message=' . urlencode($errorMsg);
  
  header('Location: ' . $redirectUrl);
  exit();
}


$data = [
  'status' => 1,
  'subscription_duration' => $billing_cycle,
  'start_date' => $start_date->format('Y-m-d'),
  'expiration_date' => $expiration_date
];

require view('memberships/show.view.php', 
[
  'data' => $data
]);
