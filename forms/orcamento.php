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
    $mail->setFrom($_POST['email'], $_POST['cliente']);
    $mail->addAddress($receiving_email_address, utf8_decode('Orçamento Solução Info.')); // Name is optional

    // Content
    $mail->isHTML(true);                             // Set email format to HTML
    $mail->Subject = utf8_decode("Orçamento enviado pelo Site");
    
    $body = "<div style='font-size:12pt'>";
    $body .= "<p style='font-size:15pt'>SOLUÇÃO INFO<br/>";
    $body .= "<b><span style='font-size:10pt'>ASSISTÊNCIA TÉCNICA ESPECIALIZADA</b></span></p>";
    $body .= "<p><b>Data / Hora: </b>".date('d/m/Y H:i')."</p>";
    $body .= "<hr style='border:1px solid black'>";
    $body .= "<h3 style='text-align:center'>ORÇAMENTO DE ASSISTÊNCIA TÉCNICA ENVIADA PELO SITE</h3>";
    $body .= "<hr style='border:1px solid black'>";
    $body .= "<h3>DADOS DO CLIENTE</h3>";
    $body .= "<p style='line-height:1.5;'><b>CLIENTE: </b>" . $_POST['cliente'] ."</p>";
    $body .= "<p style='line-height:1.5;'><b>TELEFONE / WHATSAPP: </b>" . $_POST['telefone'] ."</p>";
    $body .= "<p style='line-height:1.5;'><b>E-MAIL: </b>" . $_POST['email'] ."</p>";
    $body .= "<h3>INFORMAÇÕES SOBRE O EQUIPAMENTO</h3>";
    $body .= "<p style='line-height:1.5;'><b>MARCA / MODELO: </b>" . $_POST['marcaModelo'] ."</p>";
    $body .= "<p style='line-height:1.5;'><b>DEFEITO: </b><br/>" . $_POST['defeito'] ."</p>";
    $body .= "</div>";
    
    $mail->Body    = utf8_decode($body);

    $mail->send();
    echo 'OK';
} catch (Exception $e) {
    die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
}