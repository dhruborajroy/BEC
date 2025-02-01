<?php
die;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;                 //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'hackerdhrubo99@gmail.com';                     //SMTP username
$mail->Password   = 'xnkbvrpvlmedwgtl';                               //SMTP password
$mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
$mail->Port       = 587;         //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
$mail->setFrom('from@example.com', 'Mailer');
$mail->addAddress('dhruborajroy3@gmail.com');
if($attachment!=""){
    $mail->addAttachment($attachment);
}
$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = $html;

if($mail->send()){
    return "done";
}else{
    return "error";
}