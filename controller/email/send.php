<?php

require base_path('vendor/autoload.php');
use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer;

$secret_key = '6LcbNzkpAAAAAE7_vzhWXaHONMeu89J4mJewKcmx';

$post_data = $val_err = $status_msg = '';
$status = 'error';

// $test = isset($_POST['submit_frm']);
// dd($test);

if(isset($_POST['submit_frm'])){

  $post_data = $_POST;
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $message = trim($_POST['message']);

  if(empty($name)){
    $val_err .= 'Please enter your name. <br/>';
  }

  if(empty($email) || filter_var($email, FILTER_VALIDATE_EMAIL) === false){
    $val_err .= 'Please enter a valid email. <br/>';
  }

  // dd($val_err);
  // dd($_POST);


  if(empty($message)){
    $val_err .= 'Please enter a message. <br/>';
  }

  // $test = $_POST['g-recaptcha-response'];
  // dd($test);

  if(empty($val_err)){

    // $api_url = 'https://www.google.com/recaptcha/api/siteverify';
    // $resq_data = array(
    //   'secret' => $secret_key,
    //   'response' => $_POST['g-recaptcha-response'],
    //   'remote_ip' => $_SERVER['REMOTE_ADDR']
    // );

    // $curl_config = array(
    //   CURLOPT_URL => $api_url,
    //   CURLOPT_POST => true,
    //   CURLOPT_RETURNTRANSFER => true,
    //   CURLOPT_POSTFIELDS => $resq_data

    // );

    // $ch = curl_init();
    // curl_setopt_array($ch, $curl_config);
    // $response = curl_exec($ch);
    // curl_close($ch);

    // $reponse_data = json_decode($respose);

    // dd($response_data);

    if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){
      $api_url = 'https://www.google.com/recaptcha/api/siteverify';
      $resq_data = array(
        'secret' => $secret_key,
        'response' => $_POST['g-recaptcha-response'],
        'remote_ip' => $_SERVER['REMOTE_ADDR']
      );

      $ch = curl_init();

      $curl_config = array(
        CURLOPT_URL => $api_url,
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $resq_data,
        CURLOPT_SSL_VERIFYPEER => false

      );
 
      curl_setopt_array($ch, $curl_config);
      $response = curl_exec($ch);

      if(curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
        exit();
      }
    
      curl_close($ch);
      // dd($response);
      // dd(json_decode($response, true));

      $response_data = json_decode($response, true);
      // dd($response_data);


      if($response_data["success"]){

        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = 'manutechproject2023@gmail.com';
        $mail->Password = 'kyobhdemvglooxqw';
        $mail->setFrom('manutechproject2023@gmail.com', 'Your Name');
        $mail->addReplyTo('manutechproject2023@gmail.com', 'Your Name');
        $mail->addAddress('manutechproject2023@gmail.com', 'Receiver Name');
        $mail->Subject = 'Checking if PHPMailer works';
        // $mail->msgHTML(file_get_contents('message.html'), __DIR__ . '/../' . "controller/email/" );
        $mail->Body = "This is just a plain text message body {$name}, {$email}, {$message}";
        //$mail->addAttachment('attachment.txt');
        if (!$mail->send()) {
            // echo 'Mailer Error: ' . $mail->ErrorInfo;
            $status_msg = 'Ups! There was an error, try again!';

          } else {
            // echo 'The email message was sent.';
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