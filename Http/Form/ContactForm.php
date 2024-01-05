<?php

namespace Core\Form;

class ContactForm extends FormHandler
{

    public function submitForm()
    {
        $config = require base_path('config.php');
        $smtpConfig = $config['smtp'];

        $formFields = $this->getFormFields();

        $mail = new EmailSender($formFields, $smtpConfig);
        $result = $mail->sendEmail();

        return $result;
    }
}
