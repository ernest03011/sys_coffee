<?php

// REFACTOR - USE AUTLOADING AND AVOID DEPENDCY INJECTION 
// USE NAMESPACE
// USE PSR STANDARD 

require base_path('vendor/autoload.php');
use Core\Validator;
use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer;

// Load SMTP settings
$config = require base_path('config.php');
extract(array_map("htmlspecialchars", $config['smtp']), EXTR_PREFIX_ALL, 'smtp');

require base_path('Validator.php');

$secret_key = '6LcbNzkpAAAAAE7_vzhWXaHONMeu89J4mJewKcmx';

$post_data = $val_err = $status_msg = '';
$status = 'error';

if(isset($_POST['submit_frm'])){

  $post_data = array_map("htmlspecialchars", $_POST);

  $name = trim($post_data['name']);
  $email = trim($post_data['email']);
  $message = trim($post_data['message']);  

  if(!Validator::string($name)){
    $val_err .= 'A name is required. <br/>';
  }
  if(!Validator::email($email)){
    $val_err .= 'The email is required. <br/>';
  }
  if(!Validator::string($message)){
    $val_err .= 'The message is required. <br/>';
  }


  // USE ISSET INSTEAD OF !EMPTY
  if(empty($val_err)){


    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){

      // REFACTOR - CREATE THESE VARIABLES AS CONSTANTS

      $api_url = 'https://www.google.com/recaptcha/api/siteverify';
      $resq_data = array(
        'secret' => $secret_key,
        'response' => $_POST['g-recaptcha-response'],
        'remote_ip' => $_SERVER['REMOTE_ADDR']
      );
      
      $response = executeApiCall($api_url, $resq_data);

      if ($response == false) {
          // API call was successful, handle $response as needed
          $status_msg = 'Ups! There was an error, try again!';

          require view('contact.view.php', [
            'status' => $status ?? '',
            'status_msg' => $status_msg ?? ''
          ]);

      } 

      $response_data = json_decode($response, true);

      // dd($response_data['success']);

      if($response_data["success"]){
        
        // REFACTOR - CREATE A SEPERATE FILE IN ORDER TO SEND EMAILS
        $mail->isSMTP();
        $mail->SMTPDebug = $smtp_debug;
        $mail->Host = $smtp_host;
        $mail->Port = $smtp_port;
        $mail->SMTPSecure = $smtp_secure;
        $mail->SMTPAuth = $smtp_auth;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->setFrom("{$smtp_set_from}", 'Your Name');
        $mail->addReplyTo("{$smtp_add_reply_to}", 'Your Name');
        $mail->addAddress("{$smtp_receiver_address}", 'Receiver Name');
        $mail->Subject = 'Checking if PHPMailer works';
        $mail->Body = "This is just a plain text message body {$name}, {$email}, {$message}";
        
        if (!$mail->send()) {
            $status_msg = 'Ups! There was an error, try again!';

          } else {
            $status = 'success';
            $status_msg = 'Thank you! Your contact request has been submitted sucessfully';
            $post_data = '';
        }

      }else{
        $status_msg = 'The reCAPTCHA verification failed, please try again.';
      }

    }else{
      $status_msg = 'Something went wrong, please try again.';
    }

  }else{
    $val_err = !empty($val_err) ? '<br/>'.trim($val_err, '<br/>') : '';
    $status_msg = 'Please fill all the mandatory fields: ' . $val_err;
  }

  require view('contact.view.php', [
    'status' => $status ?? '',
    'status_msg' => $status_msg ?? ''
  ]);


}