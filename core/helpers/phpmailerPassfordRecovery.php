<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Archivos de la libreria
require '../../../libraries/PHPMailer-master/src/Exception.php';
require '../../../libraries/PHPMailer-master/src/PHPMailer.php';
require '../../../libraries/PHPMailer-master/src/SMTP.php';
//archivos del model usuario

require '../../models/usuarios.php';

class SendMail
{

    public function sendRMail()
    {
        //Generador de un string aleatoreo de 7 digitos.
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $verificationCode = substr(str_shuffle($permitted_chars), 0, 7);
        echo $verificationCode;

        $mail = new PHPMailer(true);
        $usuario = new Usuarios;
        

        if ($usuario->getCorreo()) {
            echo $usuario->correo;
            if ($usuario->setCodigoPassUsuario($verificationCode)) {
                if ($usuario->ingresarCodigoPassUsuario()) {
                    
                    
                    //Server settings
                    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                      // Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = 'tienda.vin.de.terre@gmail.com';        // SMTP username
                    $mail->Password   = 'Tienda123';                               // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    //Recipients
                    $mail->setFrom('tienda.vin.de.terre@gmail.com', 'Tienda Vin De Terre');
                    $mail->addAddress($usuario->correo);     // Add a recipient   

                    // Content
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Codigo de veriificación Tienda Vin De Terre';
                    $mail->Body    = 'Codigo: <strong>' . $usuario->codigo_pass_usuario . '.</strong> ';
                    $mail->AltBody = 'Codigo: ' . $usuario->codigo_pass_usuario . '.';

                    $mail->send();
                    echo 'Message has been sent';
                } else {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                echo 'Codigo incorrecto';
                
                
            }
        } else {
            echo 'Correo incorrecto ASD';
            
        }
    }
}
