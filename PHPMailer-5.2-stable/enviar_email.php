<?php
require 'PHPMailerAutoload.php';
session_start();

$nome 	    = $_POST['inputName'];
$email 	    = $_POST['inputName'];
$mensagem  = $_POST['mensagem'];
$arquivo   = $_FILES["arquivo"];

$assunto   = $_POST['assunto'];

$corpoMSG = 
"<strong>Nome:</strong> $nome<br> <strong>Mensagem:</strong> $mensagem";
// chamada da classe		
require_once('class.phpmailer.php');
// instanciando a classe
$mail   = new PHPMailer();
// email do remetente
$mail->SetFrom('gestao.ti@cmgb.com.br', 'remetente');
// email do destinatario
$address = "gestao.ti@cmgb.com.br";
$mail->AddAddress($address, "destinatario");
// assunto da mensagem
$mail->Subject = $assunto;
// corpo da mensagem
$mail->MsgHTML($corpoMSG);
// anexar arquivo
$mail->AddAttachment($arquivo['tmp_name'], $arquivo['name']);

if(!$mail->Send()) {
  echo "Erro: " . $mail->ErrorInfo;
 } else {
  echo "Mensagem enviada com sucesso!";
 }


?>