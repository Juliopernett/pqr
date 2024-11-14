<?php
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
/*$mail->IsSMTP();                           // telling the class to use SMTP
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "smtp.gmail.com"; // set the SMTP server
$mail->Port       = 587;   */
//$mail->IsSMTP();   
$mail->IsMail();
$mail ->SMTPSecure  =  'ssl' ;                         // telling the class to use SMTP
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "smtp.gmail.com"; // set the SMTP server
$mail->Port       = 465;                     // set the SMTP port
//$mail->Username   = "m"; // SMTP account username
//$mail->Password   = "";        // SMTP account password
$mail->Username   = "el correo"; // SMTP account username
$mail->Password   = "la contraseña";        // SMTP account password
$mail->setFrom('correo para quien va', 'Andres');
$mail->addAddress('el mismo de arriba', 'Recibe');
$mail->Subject  = 'First PHPMailer Message';
$mail->Body     = 'Hi! This is my first e-mail sent through PHPMailer.';
if(!$mail->send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}