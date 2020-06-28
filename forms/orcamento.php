<?php
require("EnviaEmail.php");

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

//Server settings
$mail = new EnviaEmail;
$mail->setRemetente($_POST['email'], $_POST['name']);
$mail->setDestino('contato@solucaoinfo.inf.br', 'Orçamento Solução Info.');
$mail->setAssunto("Orçamento enviado pelo Site");
$mail->setMensagem($body);
$mail->enviar();