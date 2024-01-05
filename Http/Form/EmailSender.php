<?php

namespace Core\Form;

// require base_path('vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;

class EmailSender{

  protected $formFields;
  protected $smtpConfig;

  public function __construct(array $formFields, array $smtpConfig)
  {
    $this->formFields = $formFields;  
    $this->smtpConfig = $smtpConfig;
  }

  public function sendEmail()
  {

    $mail = new PHPMailer;
    extract(array_map("htmlspecialchars", $this->smtpConfig), EXTR_PREFIX_ALL, 'smtp');

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
    $mail->Body = 
      "This is just a plain text message body 
      {$this->formFields['name']}, {$this->formFields['email']}, {$this->formFields['message']}";
    
    if (!$mail->send()) {
        $status = 'failed';
        $status_msg = 'Ups! There was an error, try again!';

      } else {
        $status = 'successful';
        $status_msg = 'Thank you! Your contact request has been submitted sucessfully';
    }

    return [
      $status,
      $status_msg
    ];
  }
}