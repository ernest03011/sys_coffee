<?php

namespace Http\Form;

use PHPMailer\PHPMailer\PHPMailer;

class EmailSender{

  protected $receiver_name;
  protected $smtpConfig;
  protected $body;

  public function __construct(string $receiver_name, array $smtpConfig, string $body)
  {
    $this->receiver_name = htmlspecialchars($receiver_name);  
    $this->smtpConfig = $smtpConfig;
    $this->body = htmlspecialchars($body);

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
    $mail->addAddress("{$smtp_receiver_address}", $this->receiver_name);
    $mail->Subject = 'Checking if PHPMailer works';
    $mail->Body = $this->body;
    
    if (!$mail->send()){
        $status = 'failed';
        $status_msg = 'Ups! There was an error, try again!';

      }else {
        $status = 'successful';
        $status_msg = 'Thank you! Your contact request has been submitted sucessfully';
    }

    return [
      $status,
      $status_msg
    ];
  }
}