<?php

namespace Http\controller\PasswordReset;

use Core\Database;
use Http\Form\ContactForm;
use Http\Form\EmailSender;

class Manager extends ContactForm
{
  private $status;
  private $error_msg;
  private $token;
  private $token_data;
  private $db;  
  private $smtp_config;

  public function __construct($config){
    $this->db = new Database($config['database']);
    $this->smtp_config = $config['smtp'];
  }

  // GETTER
  public function getToken() : string
  {
    return $this->token;
  }

  public function getTokenData() : array
  {
    return $this->token_data;
  }
  // SETTER

  public function setToken(string $token) : void 
  {
    $this->token = $token;
  }

  public function setTokenData(array $token_data) : void 
  {
    $this->token_data = $token_data;
  }

  // METHODS

  public function generateToken() : void
  {
    $this->token = bin2hex(random_bytes(32));
    // $jwt = new JwtHandler();
    // $payload = [];
    // $jwtToken = $jwt->encode("http://localhost:8080/", $payload);
    // return $random_token;
  }

  public function disableToken() : void
  {
    try {
      $db = $this->db;

      $db->query('UPDATE password_reset_tokens SET status = :status, expiry_time = :expiry_time WHERE token = :token', [
        'token' => $this->getToken(),
        'status' => 'used',
        'expiry' => "0"
      ]);


    } catch (\Exception $e) {
      // I will come back to this later on
    }

  }

  public function saveTokenToDB(string $user_id, string $status, string $expiry_time) : void
  {
    

    $token = $this->getToken();

    try {

      $db = $this->db;
      $db->query("INSERT INTO password_reset_tokens (user_id, token, status, expiry_time) VALUES (:user_id, :token, :status, :expiry_time)", [
        'user_id' => htmlspecialchars($user_id), 
        'token' => htmlspecialchars($token),
        'status' => htmlspecialchars($status), 
        'expiry_time' => htmlspecialchars($expiry_time)
      ]);

      // $test = "Try inserting this token";
      // dd($test);

    } catch (\Exception $e) {
      // $this->status = "failed";
      // $this->error_msg = "Reset Password Failed, try again!";

      $test = "Catch errors while inserting this token";
      // dd($e);
    }

    

  }


  public function getTokenFromDB() : array
  {
    
    try {

      $db = $this->db;
      $token = $db->query('select * from password_reset_tokens where token = :token AND status = :status', [
        'token' => $this->token,
        'status' => 'pending'

      ])->find();

      $this->setTokenData($token);

    } catch (\Exception $e) {
      $token = [];
    }

    return $token;

  }

  public function isTokenValidAndPending() : bool
  {
    $token = $this->getTokenFromDB();
    $result = count($token) != 0 ? true : false;
    return $result;
  }

  public function saveLog(int $userId, string $actionType) : void
  {
    try {

      $db = $this->db;
      $db->query("INSERT INTO password_reset_logs (user_id, action_type, timestamp) VALUES (:user_id, :action_type, :timestamp", [
        'user_id' => htmlspecialchars($userId), 
        'actionType' => htmlspecialchars($actionType),
        'status' => htmlspecialchars("2023-03-01 14:15:00")
      ]);

    } catch (\Exception $e) {
      $this->status = "failed";
      $this->error_msg = "Reset Password Failed, try again!";
    }

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

      $db = $this->db;
      $attempts = $db->query('select * from password_reset_attempts where user_id = :user_id', [
        'user_id' => $$user_id

      ])->find();

      $attempts = count($attempts);

    } catch (\Exception $e) {
      $attempts = 0;
    }


    return $attempts;
  }

  public function isLimitReached(int $user_id) : bool
  {
    $isLimitReached = false;
    try {

      $db = $this->db;
      $result = $db->query('select * from password_reset_attempts where user_id = :user_id', [
        'user_id' => $$user_id

      ])->find();

      // I need to assign the value

    } catch (\Exception $e) {
      $this->status = "failed";
      $this->error_msg = "Reset Password Failed, try again!";

      return [$this->status, $this->error_msg];
    }

    return $isLimitReached;

  }

  public function isIPBanned(string $ipAddress) : bool
  {

    // I still need to work on it. 
    
    $isIPBanned = false;
    try {

      $db = $this->db;
      $ip_address = $db->query('select * from password_reset_ip_tracking where ip_address = :ip_address', [
        'ip_address' => $ipAddress

      ])->find();

      $ip_address = count($ip_address);

    } catch (\Exception $e) {
      $ip_address = 0;
    }

    // $result = 0;

    return $isIPBanned;
  }

  public function submitForm()
  {
  
      // $formFields = $this->getFormFields();
      // $receiver_name = $formFields['name'];
      $url = "http://localhost:8080/forgot-password/token/?token={$this->token}";
      $receiver_name = "Pedro";
      $body = "This is the token: " . $url;

      $mail = new EmailSender($receiver_name, $this->smtp_config, $body);
      $result = $mail->sendEmail();

      return $result;
  }
  
}
