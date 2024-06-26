<?php

use Core\Database;
use Http\controller\PasswordReset\Manager;


$config = require base_path('config.php');
$db = new Database($config['database']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = htmlspecialchars($_POST['email']);

  try {

    $user = $db->query('select * from users where email = :email', [
      'email' => $email
    ])->find();

    if(empty($user))
    {
      redirect("/forgot-password", [
        'message' => 'Unable to reset the password, try again!',
        'modifiers' => 'type=error&color=red'
      ]);
    }

    $pass_reset_manager = new Manager($config);

    // Generate Token.
    $pass_reset_manager->generateToken();

    // Get token
    $token = $pass_reset_manager->getToken();

    // Save Token 
    $pass_reset_manager->saveTokenToDB((int)$user["user_id"], 'pending', "2023-03-01 12:00:00");
    
    // Send email with URL with Token
    $pass_reset_manager->submitForm();

    // Generate a log

    redirect("/forgot-password", [
      'message' => 'Email Has Been Sent, please check your email adress!',
      'modifiers' => 'type=success&color=green'
    ]);

  } catch (\Exception $th) {
    redirect("/forgot-password", [
      'message' => 'Unable to reset the password, try again!',
      'modifiers' => 'type=error&color=red'
    ]);
  }

}
