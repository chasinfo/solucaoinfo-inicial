<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
require '../env.php';

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'contato@solucaoinfo.inf.br';

try {
    //Server settings
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();                        // Send using SMTP
    $mail->Host       = MAILGUN_HOST;       // Set the SMTP server to send through
    $mail->SMTPAuth   = true;               // Enable SMTP authentication
    $mail->Username   = MAILGUN_USER_NAME;  // SMTP username
    $mail->Password   = MAILGUN_PASSWORD;   // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = MAILGUN_PORT;       // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress($receiving_email_address, utf8_decode('Contato Solução Info.')); // Name is optional

    // Content
    $mail->isHTML(true);                             // Set email format to HTML
    $mail->Subject = utf8_decode($_POST['subject']);
    $mail->Body    = utf8_decode($_POST['message']);

    $mail->send();
    echo 'OK';
} catch (Exception $e) {
    die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
}