<?php
require("EnviaEmail.php");

//Server settings
$mail = new EnviaEmail;
$mail->setRemetente($_POST['email'], $_POST['name']);
$mail->setDestino('contato@solucaoinfo.inf.br', 'Contato Solução Info.');
$mail->setAssunto($_POST['subject']);
$mail->setMensagem($_POST['message']);
$mail->enviar();