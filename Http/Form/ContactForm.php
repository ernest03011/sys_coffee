<?php

namespace Core\Form;

// require base_path('controller/Form/ContactFormHandler.php');
// require base_path('controller/Form/EmailSender.php');

// $test = base_path('controller/form/ContactFormHandler.php');
// dd($test);



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
