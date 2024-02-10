<?php

// Verify Token Validity:

use Http\controller\PasswordReset\Manager;

$config = require base_path('config.php');
$pass_reset_manager = new Manager($config);

$token = htmlspecialchars($_GET['token']);

$pass_reset_manager->setToken($token);

// The isTokenValidAndPending method is called to verify the validity and status of the token in the password_reset_tokens table.

$isAValidAndPendingToken = $pass_reset_manager->isTokenValidAndPending();

if(! $isAValidAndPendingToken){

  redirect("/forgot-password", [
    'message' => 'Something Went wrong, Try submitting reset password form again!',
    'modifiers' => 'type=error&color=red'
  ]);

}

  $pass_reset_manager->disableToken();

  $token_data = $pass_reset_manager->getTokenData();

  // Save Log for Successful Reset:
  // The saveLog method is called to log the successful password reset in the password_reset_logs table, recording the user's ID and the action type as 'password_reset_success'.

  // ----* saving logs is pending, and I think that it would be better to save an attempt now, and only save logs once it is fully reset. 

  // I will come back to this later on. 

  // Require edit.view.php
  // dd($token_data['user_id']);

require view("PasswordReset/edit.view.php", $attributes = [
 'id' => (int)$token_data['user_id']
]);






