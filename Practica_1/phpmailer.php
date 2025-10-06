<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'libs/vendor/autoload.php';

function sendMail($nom, $email, $cosmissatge) {
    
    try {
        $mail = new PHPMailer(true);

        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                        //Enable verbose debug output
        $mail->isSMTP();                                                //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                           //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                       //Enable SMTP authentication
        $mail->Username   = ''; // Introduzca tu email                  //SMTP username
        $mail->Password   = ''; // Introduzca tu contraseña             //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                //Enable implicit TLS encryption
        $mail->Port       = 465;                                        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($mail->Username, 'Anderson Perez');
        $mail->addAddress($email, $nom);                                //Add a recipient

        //Content
        $mail->isHTML(true);                                            //Set email format to HTML
        $mail->Subject = "Envio de correo desde PHPMailer";
        $mail->Body    = $cosmissatge;

        $mail->send();
        return "Mensaje Enviado";
    } catch (Exception $e) {
        return "Mailer Error: {$mail->ErrorInfo}";
    }
}