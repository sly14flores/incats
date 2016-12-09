<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {
	
	case "list":
	
	$con = new pdo_db();
	$results = $con->getData("SELECT id, student_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) full_name, gender, contact_no, email, username, IF(is_activated = 1,'Active','Inactive') status FROM accounts WHERE account_type != 'Administrator'");
	
	echo json_encode($results);		
	
	break;
	
	case "view":
	
	$con = new pdo_db();
	$perinfo = $con->getData("SELECT id, student_id, first_name, middle_name, last_name, gender, birthdate, age, address, contact_no, email FROM accounts WHERE id = '$_POST[id]'");
	
	if ($perinfo[0]['birthdate'] == "0000-00-00") $perinfo[0]['birthdate'] = "";
	else $perinfo[0]['birthdate'] = date("m/d/Y",strtotime($perinfo[0]['birthdate']));
	
	if ($perinfo[0]['age'] == 0) $perinfo[0]['age'] = "";

	$scholarinfo = $con->getData("SELECT * FROM scholars_infos WHERE account_id = ".$perinfo[0]['id']);
	unset($scholarinfo[0]['account_id']);
	
	if (sizeof($scholarinfo)) {
		if (($scholarinfo[0]['mother_bday'] == "0000-00-00") || ($scholarinfo[0]['mother_bday'] == "1970-01-01")) $scholarinfo[0]['mother_bday'] = "";
		else $scholarinfo[0]['mother_bday'] = date("m/d/Y",strtotime($scholarinfo[0]['mother_bday']));
		
		if (($scholarinfo[0]['father_bday'] == "0000-00-00") || ($scholarinfo[0]['father_bday'] == "1970-01-01")) $scholarinfo[0]['father_bday'] = "";
		else $scholarinfo[0]['father_bday'] = date("m/d/Y",strtotime($scholarinfo[0]['father_bday']));		
	}
	
	$siblings = $con->getData("SELECT id, sibling_name, sibling_age, sibling_grade, sibling_occupation FROM siblings WHERE account_id = ".$perinfo[0]['id']);
	
	$accinfo = $con->getData("SELECT id, username, password, password re_type_password FROM accounts WHERE id = ".$perinfo[0]['id']);
	
	if (sizeof($scholarinfo) == 0) $scholarinfo[0] = [];
	$results = array("perinfo"=>$perinfo[0],"accinfo"=>$accinfo[0],"scholarinfo"=>$scholarinfo[0],"siblings"=>$siblings);
	
	echo json_encode($results);	
	
	break;
	
	case "delete":
	
	$con = new pdo_db('accounts');
	
	$scholarships = $con->getData("SELECT id FROM scholarships WHERE account_id = ".$_POST['id'][0]);
	foreach ($scholarships as $scholarship) {
		$requirements = $con->getData("SELECT id, doc_title FROM requirements WHERE scholarship_id IN (".implode(",",$scholarship['id']).")");
	}
	
	foreach ($requirements as $key => $requirement) {
		unlink("../requirements/".$requirement['doc_title']);
	}	
	
	$con->deleteData(array("id"=>implode(",",$_POST['id'])));	
	
	break;
	
	case "activation_code":
	
	$con = new pdo_db();
	
	$activation_code = $con->getData("SELECT activation_code FROM account_activations WHERE account_id = $_POST[id]");

	echo json_encode($activation_code[0]);
	
	break;
	
	case "activate":
	
	$con = new pdo_db("accounts");
	
	$activate = $con->updateData(array("is_activated"=>1,"id"=>$_POST['id']),'id');
	
	notifyActivation($_POST['id'],$con);
	
	break;
	
}

function notifyActivation($account_id,$con) {

$account = $con->getData("SELECT accounts.email, accounts.first_name, accounts.last_name, account_activations.activation_code FROM accounts LEFT JOIN account_activations ON accounts.id = account_activations.account_id WHERE accounts.id = $account_id");
$info = $account[0];
	
$to = $info['email'];

$subject = "INCATS Account Activated";

$headers = "From: incats2016@gmail.com\r\n";
$headers .= "Reply-To: incats2016@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<!DOCTYPE html>';
$message .=	'<html lang="en">';
$message .= '<body>';
$message .= '<p>Dear '.$info['first_name'].' '.$info['last_name'].',</p>';
$message .= '<p>Congratulations!</p>';
$message .= '<p>Your account has been activated.  You may now login to complete your profile and apply for scholarship.</p>';
$message .= '<br><br>';
$message .= '<p>Thank you!</p>';
$message .= '<br>';
$message .= '<p>Administrator</p>';
$message .= '</body>';
$message .= '</html>';

mail($to,$subject,$message,$headers);
	
}

?>