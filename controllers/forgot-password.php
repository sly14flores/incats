<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

$con = new pdo_db();

$account = $con->getData("SELECT * FROM accounts WHERE username = '$_POST[username]'");
sendPassword($account[0]['id'],$con);

echo sizeof($account);

function sendPassword($account_id,$con) {

$account = $con->getData("SELECT email, first_name, last_name, password FROM accounts WHERE id = $account_id");
$info = $account[0];

$to = $info['email'];

$subject = "INCATS Password Recovery";

$headers = "From: incats2016@gmail.com\r\n";
$headers .= "Reply-To: incats2016@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<!DOCTYPE html>';
$message .=	'<html lang="en">';
$message .= '<body>';
$message .= '<p>Dear '.$info['first_name'].' '.$info['last_name'].',</p>';
$message .= '<p>Your password is <strong>'.$info['password'].'</strong></p>';
$message .= '<br><br>';
$message .= '<p>Thank you!</p>';
$message .= '<br>';
$message .= '<p>Administrator</p>';
$message .= '</body>';
$message .= '</html>';

mail($to,$subject,$message,$headers);
	
}

?>