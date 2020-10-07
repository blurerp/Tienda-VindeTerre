<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//Archivos de la libreria
require '../../libraries/PHPMailer-master/src/Exception.php';
require '../../libraries/PHPMailer-master/src/PHPMailer.php';
require '../../libraries/PHPMailer-master/src/SMTP.php';
//archivos del model usuario
require '../models/usuarios.php';


$usuario = new Usuarios;
$permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';    
$verificationCode = substr(str_shuffle($permitted_chars), 0, 7);
echo $verificationCode;


// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                      // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'tienda.vin.de.terre@gmail.com';        // SMTP username
    $mail->Password   = 'Tienda13';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('tienda.vin.de.terre@gmail.com', 'Tienda Vin De Terre');
    $mail->addAddress('jlrgonzalez13@gmail.com', 'JLR');     // Add a recipient   

    

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body PUTITO <b>'. substr(str_shuffle($permitted_chars), 0, 7) .'</b>';
    $mail->AltBody = 'This is the body in plain text '. substr(str_shuffle($permitted_chars), 0, 7) .' for non-HTML mail clients FUCK YEAH';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



?>