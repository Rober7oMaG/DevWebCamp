<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $name;
    public $token;
    
    public function __construct($email, $name, $token)
    {
        $this->email = $email;
        $this->name = $name;
        $this->token = $token;
    }

    public function sendConfirmation() {
        // create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('accounts@devwebcamp.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirm your Account';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $content = "<html>";
        $content .= "<p><strong>Hello, " . $this->name . "! </strong>";
        $content .= "Welcome to DevWebCamp. To confirm your account, click the link below: </p>";
        $content .= "<p>Click here: <a href='" . $_ENV['HOST'] . "/confirm-account?token=" . $this->token . "'>Confirm account.</a></p>";
        $content .= "<p>If you didn't create the account, you can ignore the message.</p>";        
        $content .= '</html>';

        $mail->Body = $content;

        //Enviar el mail
        $mail->send();
    }

    public function sendRecovery() {
        // Create a new object
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];
    
        $mail->setFrom('accounts@devwebcamp.com');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reset your Password';

        // Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        // Define content
        $content = "<html>";
        $content .= "<p><strong>Hello, " . $this->name . "! </strong>";
        $content .= "You requested to reset your password, click the link below to do it: </p>";
        $content .= "<p>Click here: <a href='" . $_ENV['HOST'] . "/reset?token=" . $this->token . "'>Reset Password</a></p>";        
        $content .= "<p>If you didn't request this change, you can ignore the message.</p>";        
        $content .= '</html>';

        $mail->Body = $content;

        //Enviar el mail
        $mail->send();
    }
}