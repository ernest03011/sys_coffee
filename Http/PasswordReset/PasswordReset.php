<?php

namespace Http\PasswordReset;

use Http\Form\ContactForm;
use Core\JwtHandler;

class PasswordResetManager extends ContactForm
{

  public function __construct(){}

  public function generateToken() : string
  {
    $random_token = bin2hex(random_bytes(32));

    // $jwt = new JwtHandler();
    // $payload = [];
    // $jwtToken = $jwt->encode("http://localhost:8080/", $payload);

    $this->saveTokenToDB($random_token);

    return $random_token;
  }

  public function saveTokenToDB(){

    try {
      //code...
    } catch (\Exception $e) {
      //throw $th;
    }

  }

  public function getTokenFromDB(string $token){

    try {
      //code...
    } catch (\Throwable $th) {
      //throw $th;
    }

  }

  public function isTokenValidAndPending(string $token) : bool
  {
    $token = $this->getTokenFromDB($token);
    $result = isset($token) ? true : false;
    return true;
  }

  public function saveLog(int $userId, string $actionType) : void
  {
    //     Password Reset Request:

    // actionType could be set to "password_reset_request" when a user initiates a request to reset their password.

    // Password Reset Success:

    // actionType could be set to "password_reset_success" when a user successfully resets their password.

    // Password Reset Failure:

    // actionType could be set to "password_reset_failure" when a user fails to reset their password (e.g., incorrect token).

    // IP Ban:

    // actionType could be set to "ip_ban" when an IP address is banned due to suspicious or malicious activity.

    // Token Generation:

    // actionType could be set to "token_generation" when a new password reset token is generated.

  }

  public function getAttempts(int $user_id) : int
  {
    try {
      //code...
    } catch (\Exception $e) {
      //throw $th;
    }

    return 12;
  }

  public function isLimitReached(int $user_id) : bool
  {
    try {
      //code...
    } catch (\Exception $e) {
      //throw $th;
    }
    return false;
  }

  public function isIPBanned(string $ipAddress) : bool
  {
    try {
      //code...
    } catch (\Exception $e) {
      //throw $th;
    }
    return false;
  }
  
}
