<?php

namespace Http\Form;

class ContactForm extends FormHandler
{

    public function submitForm()
    {
        $config = require base_path('config.php');
        $smtpConfig = $config['smtp'];

        $formFields = $this->getFormFields();
        $receiver_name = $formFields['name'];

        $body = "This is just a plain text message body " . 
        $formFields['name'] . ", " . $formFields['email'] . ", " . $formFields['message'];

        $mail = new EmailSender($receiver_name, $smtpConfig, $body);
        $result = $mail->sendEmail();

        return $result;
    }
}
