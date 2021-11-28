<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer;
$mail->CharSet = 'utf-8';



$mail->isSMTP();                
$mail->Host = 'smtp.mail.ru';  																
$mail->SMTPAuth = true;
$mail->Username = 'kkewno';
$mail->Password = 'NoToFa_77';
$mail->SMTPSecure = 'ssl';        
$mail->Port = 465;

$mail->setFrom('kkewno@mail.ru', 'kkewno@mail.ru'); 
$mail->addAddress('resume@ooo-modern.ru');     

$mail->isHTML(true);          

$body = '<p><strong>Тело письма:</strong></p>';

if (trim(!empty($_POST['theme']))) {
	$mail->Subject = 'Questions from DreamCreditMaker: '. $_POST['theme'];
} else {
	$mail->Subject = 'Входящее письмо';
}

if (trim(!empty($_POST['email']))) {
	$body.='<p><strong>Email:</strong> '.$_POST['email'].'</p>';
}
if (trim(!empty($_POST['name']))) {
	$body.='<p><strong>Name:</strong> '.$_POST['name'].'</p>';
}
if (trim(!empty($_POST['question']))) {
	$body.='<p><strong>Question:</strong> '.$_POST['question'].'</p>';
}
if (trim(!empty($_POST['tel']))) {
	$body.='<p><strong>Phone Number:</strong> '.$_POST['tel'].'</p>';
} else {
	$body.='<p><strong>Phone Number:</strong>null</p>';
}

$mail->Body = $body;



$mail->AltBody = '';
$message;

if(!$mail->send()) {
    $message = 'Error';
} else {
    $message = 'Data is true';
}

$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>