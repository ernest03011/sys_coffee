<?php

// dd("Hello");

namespace Core\Form;

class FormHandler{

  private $form_fields;
  private $api_url = 'https://www.google.com/recaptcha/api/siteverify';
  private $secret_key = '6LcbNzkpAAAAAE7_vzhWXaHONMeu89J4mJewKcmx';
  // private $remote_ip = $_SERVER['REMOTE_ADDR'];
  
  public function __construct(array $form_fields)
  {
    $this->form_fields = $form_fields;
  }

  public function recaptchaVerification(string $captcha_resp)
  {
    // $api_url = 'https://www.google.com/recaptcha/api/siteverify';
    $resq_data = array(
        'secret' => $this->secret_key,
        // 'response' => $_POST['g-recaptcha-response'],
        'response' => $captcha_resp,
        'remote_ip' => $_SERVER['REMOTE_ADDR'],
    );

    $response = executeApiCall($this->api_url, $resq_data);
    $response_data = [];

    if ($response == false) {
      // API call was successful, handle $response as needed
      $status = 'failed';
      $status_msg = 'Ups! There was an error, try again!';

      
    }else{
      $status = 'sucessful';
      $status_msg = "";
      $response_data = json_decode($response, true);

    } 

    return [
      $status,
      $status_msg,
      $response_data
    ];
  }

  public function getFormFields()
  {
    return $this->form_fields;
  }

}
