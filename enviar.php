<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer();
$emailenvio  = $_POST['consultor'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$assunto = $_POST['assunto'] . " - " . $_POST['complemento'];
$mensagem = $_POST['mensagem'];



try{               
  $mail->isSMTP();
  $mail->Host       = "ssl://smtp.gmail.com";
  $mail->Port       = 465;
  $mail->SMTPSecure = 'tls';
  $mail->SMTPAuth   = true;
  $mail->Username   = 'contato.habeasdatainformatica@gmail.com';                     
  $mail->Password   = 'saebah2022*';
  $mail->CharSet    = 'UTF-8';
  $mail->setFrom('contato.habeasdatainformatica@gmail.com', $nome);
  $mail->addAddress($emailenvio);
  $mail->Subject = $assunto;
  $mail->isHTML(true);  
  
  $mail->AltBody = "De: {$nome}\n\nEmail: {$email}\n\nMensagem:\n\n {$mensagem}";
  
  $mensagem = str_replace("\n","<br>",$mensagem);
  $mail->Body = "<b>De:</b> {$nome}<br><br><b>Email:</b> {$email}<br><br><b>Mensagem:</b><br><br> {$mensagem}";

  $mail->preSend();

  if(!$mail->send()) {
    echo "<script>alert('Não foi possível enviar o e-mail. Tente novamente ou entre em contato com ' . $emailenvio); window.location.replace('https://habeasdata.com.br/contato.html');</script>";
  } 

  else {
    echo "<script>window.location.replace('https://habeasdata.com.br/contato.html');</script>";
  }

} catch (Exception $e) {
  echo "Mensagem não enviada";
}

?>