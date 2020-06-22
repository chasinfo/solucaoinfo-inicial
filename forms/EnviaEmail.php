<?php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php';
require '../env.php';

class EnviaEmail 
{
    /**
     * @var string
     */
    private $destinoNome;

    /**
     * @var string
     */
    private $destinoEmail;
    
    /**
     * @var string
     */
    private $remetenteNome;
    
    /**
     * @var string
     */
    private $remetenteEmail;
    
    /**
     * @var string
     */
    private $assunto;
    
    /**
     * @var string
     */
    private $mensagem;
    
    public function setDestino(string $email, string $nome = null) : void
    {
        $this->destinoEmail = $email;
        $this->destinoNome = !empty($nome) ? utf8_decode($nome) : null;
    }

    /**
     * @param string $mail Email do remetente
     * @param string $nome Nome do rementente, campo não obrigatório
     * @return void
     */
    public function setRemetente(string $email, string $nome = null) : void
    {
        $this->remetenteEmail = $email;
        $this->remetenteNome = !empty($nome) ? utf8_decode($nome) : null;
    }

    public function setAssunto(string $assunto): void
    {
        $this->assunto = utf8_decode($assunto);
    }

    public function setMensagem(string $mensagem): void
    {
        $this->mensagem = utf8_decode($mensagem);
    }

    public function enviar(): void
    {
        try {
            //Server settings
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();                     // Send using SMTP
            $mail->Host       = MAIL_HOST;       // Set the SMTP server to send through
            $mail->SMTPAuth   = true;            // Enable SMTP authentication
            $mail->Username   = MAIL_USER_NAME;  // SMTP username
            $mail->Password   = MAIL_PASSWORD;   // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = MAIL_PORT;       // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($this->remetenteEmail, $this->remetenteNome);
            $mail->addAddress($this->destinoEmail, $this->destinoNome); 

            // Content
            $mail->isHTML(true);                             // Set email format to HTML
            $mail->Subject = $this->assunto;
            $mail->Body    = $this->mensagem;

            $mail->send();
            echo 'OK';
        } catch (Exception $e) {
            die("Mensagem não pode ser enviada: {$mail->ErrorInfo}");
        }
    }
}