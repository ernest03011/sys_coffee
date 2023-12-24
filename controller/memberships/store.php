<?php

if (!class_exists('Database')) {
  // If not, require it
  require base_path('Database.php');
}
$config = require base_path('config.php');
$db = new Database($config['database']);

// $current_id = 3;

// $user_email = $_SESSION['user']['email'];

// $user = $db->query("select * from users where email = :email", [
//   'email' => $user_email
// ])->find();

// Testing JWT

$user_id = getCurrentUserId();


$start_date = new DateTime('now', new DateTimeZone('Asia/Taipei'));
$expiration_date = clone $start_date;

$expiration_date = $expiration_date->modify('+1 year')->format('Y-m-d');

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
  // require view('partials/membership.buy.php', $msg = [
  //   'error' => 'Unable to create the subscription, double-check the details and try again!'
  // ]); 

  // exit();
}

// dd($result);

require view('memberships/show.view.php', $user = [
  'status' => 1,
  'billing_cycle' => $billing_cycle,
  'start_date' => $start_date->format('Y-m-d'),
  'expiration_date' => $expiration_date
]);