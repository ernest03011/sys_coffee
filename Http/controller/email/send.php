<?php

use Core\Validator;
use Http\Form\ContactForm;

$post_data = $val_err = $status_msg = '';
$status = 'failed';

if (isset($_POST['submit_frm'])) {

    $post_data = array_map("htmlspecialchars", $_POST);

    $name = trim($post_data['name']);
    $email = trim($post_data['email']);
    $message = trim($post_data['message']);

    if (!Validator::string($name)) {
        $val_err .= 'A name is required. <br/>';
    }
    if (!Validator::email($email)) {
        $val_err .= 'The email is required. <br/>';
    }
    if (!Validator::string($message)) {
        $val_err .= 'The message is required. <br/>';
    }

    if (empty($val_err)) {

        $captcha_resp = $_POST['g-recaptcha-response'];

        if (isset($captcha_resp) && !empty($captcha_resp)) {

            $contactForm = new ContactForm($post_data);
        
            $resp = $contactForm->recaptchaVerification($captcha_resp);
            [$status, $status_msg, $response_data] = $resp;

            if($status == 'sucessful'){
                 $response = $contactForm->submitForm();
                [$status, $status_msg] = $response;
            }

        } else {
            $status_msg = 'Something went wrong, refresh/reload the page, and please try again.';
        }

    } else {
        $val_err = !empty($val_err) ? '<br/>' . trim($val_err, '<br/>') : '';
        $status_msg = 'Please fill all the mandatory fields: ' . $val_err;
    }

    require view('contact.view.php', [
        'status' => $status ?? '',
        'status_msg' => $status_msg ?? '',
    ]);

}
