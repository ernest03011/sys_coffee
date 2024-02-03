<?php

use Core\Database;
use Core\Validator;

// Handle POST submission 

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  // Log Password Update:

  $config = require base_path('config.php');
  $db = new Database($config['database']);

  $errors = [];

  // Retrieve form data
  $password = trim($_POST["password"]);
  $conPassword = trim($_POST["conPassword"]);

  $token = $_POST['token'];


  if(!Validator::string($password))
  {
    $errors['password'] = 'The password is required';
  }
  if(!Validator::string($conPassword))
  {
    $errors['password'] = 'The password is required';
  }

  if($password != $conPassword){
    $errors['password'] = 'Password does not match';
  }
  
  if(count($errors) != 0){
    redirect("/forgot-password/token/?token={$token}", [
      'message' => $errors['password'],
      'modifiers' => 'type=error&color=red'
    ]);
  }

  try {

    $user_id = $_POST['id'];
    $newPassword = password_hash($password, PASSWORD_DEFAULT);

    $db->query('UPDATE users SET password = :password WHERE user_id = :user_id', [
      'user_id' => $user_id,
      'password' => password_hash($password, PASSWORD_DEFAULT) // $newPassword
    ]);
            
    require view('session/create.view.php', $attributes = [
      'pass_reset_successful' => "Password has been reset. Please log in!"
    ]);
    
    
  } catch (\Exception $e) {
    redirect("/forgot-password/token/?token={$token}", [
      'message' => "Something went wrong, try adding the password again!",
      'modifiers' => 'type=error&color=red'
    ]);

  }


 

}



// The saveLog method is called again to log the password update in the password_reset_logs table, recording the user's ID and the action type as 'password_update'.

// Check and Update Attempts:

// The getAttempts method is called to check the number of password reset attempts for the user in the password_reset_attempts table.
// If the limit is not reached, a new attempt is logged in the password_reset_attempts table.

// Check Limit and Ban IP if Necessary:

// The isLimitReached method is called to check if the reset attempts have reached the configured limit in the password_reset_limits table.
// If the limit is reached, the user's IP address is logged in the password_reset_ip_tracking table, and the IP may be banned.

// User Receives Confirmation:

// The user receives a confirmation that their password has been successfully reset.