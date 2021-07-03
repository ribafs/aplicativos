<?php
//Load Composer's autoloader
require 'PHPMailer/vendor/autoload.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = 'true';                                   //Enable SMTP authentication
    $mail->Username   = 'ribafs@gmail.com';                     //SMTP username
    $mail->Password   = 'zmxn1029G@';                               //SMTP password
    $mail->SMTPSecure = "tls";         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = '587';                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('ribafs@gmail.com');
//    $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
    $mail->addAddress('ribafs@gmail.com', 'Ribamar FS');               //Name is optional. A quem se destina
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
  //  $mail->addBCC('bcc@example.com');

    //Attachments
//    $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
  //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Apenas um teste de envio de e-mail';
    $mail->Body    = 'Este é o <h3>corpo</h3> do e-mail <b>in bold!</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
$mail->smtpClose();
