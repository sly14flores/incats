<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {
	
	case "list":
	
	$con = new pdo_db();
	$results = $con->getData("SELECT scholarships.id, accounts.student_id, CONCAT(accounts.first_name, ' ', accounts.middle_name, ' ', accounts.last_name) full_name, scholarships.program, scholarships.course, scholarships.college, scholarships.semester, scholarships.year_level, scholarships.school_year, scholarships.status, scholarships.evaluated FROM scholarships LEFT JOIN accounts ON scholarships.account_id = accounts.id WHERE application_type = 'New' AND account_type != 'Administrator' AND scholarships.status IN ('On-Process','Pending')");
	
	echo json_encode($results);	
	
	break;
	
	case "Save":
	
	if ($_POST['birthdate'] != "0000-00-00") $_POST['birthdate'] = date("Y-m-d",strtotime($_POST['birthdate']));

	if (isset($_POST['re_type_password'])) unset($_POST['re_type_password']);
	
	$con = new pdo_db('accounts');
	$applicant = $con->insertData($_POST);
	$account_id = $con->insertId;
	
	$con = new pdo_db('account_activations');
	$activation = $con->getData("SELECT * FROM account_activations WHERE account_id = $account_id");
	
	if ($con->rows == 0) {
		$digits = 5;
		$activation_code = rand(pow(10, $digits-1), pow(10, $digits)-1);
		$activation = $con->insertData(array("account_id"=>$account_id,"activation_code"=>$activation_code,"date_activated"=>"CURRENT_TIMESTAMP"));
		
		sendActivationCode($account_id,$con);
	}
	
	break;
	
	case "Update":
	
	$_POST['birthdate'] = date("Y-m-d",strtotime($_POST['birthdate']));
	
	$con = new pdo_db('accounts');
	$applicant = $con->updateData($_POST,'id');
	
	break;
	
	case "view":
	
	$con = new pdo_db();

	$scholarship = $con->getData("SELECT id, application_type, programs, program, course, college, year_level, semester, school_year, status, status cache_status, evaluated, evaluated cache_evaluated FROM scholarships WHERE id = ".$_POST['id']);	
	$requirements = $con->getData("SELECT id, description, doc_rating, doc_title FROM requirements WHERE scholarship_id = ".$_POST['id']);
	
	$scholarship[0]['evaluated'] = ($scholarship[0]['evaluated'] == 0) ? false : true;
	
	$results = array("scholarship"=>$scholarship[0],"requirements"=>$requirements);
	
	echo json_encode($results);
	
	break;
	
	case "update_scholarship":
	
	$con1 = new pdo_db('scholarships');
	if ($_POST['scholarship']['status'] != $_POST['scholarship']['cache_status']) $_POST['scholarship']['status_date'] = "CURRENT_TIMESTAMP";
	unset($_POST['scholarship']['cache_status']);
	if ($_POST['scholarship']['evaluated'] != $_POST['scholarship']['cache_evaluated']) {
		if ($_POST['scholarship']['evaluated'] == 1) $_POST['scholarship']['evaluation_date'] = "CURRENT_TIMESTAMP";
	}
	unset($_POST['scholarship']['cache_evaluated']);	
	$profile = $con1->updateData($_POST['scholarship'],'id');	
	
	$con2 = new pdo_db('requirements');		
	foreach($_POST['requirements'] as $key => $value) {
		if ($value['id'] == 0) {
			$_POST['requirements'][$key]['scholarship_id'] = $_POST['scholarship']['id'];
			unset($_POST['requirements'][$key]['id']);			
			$requirements = $con2->insertData($_POST['requirements'][$key]);
		}
	}
	
	if (count($_POST['requirementsDelete']) > 0) {		
		$con2->deleteData(array("id"=>implode(",",$_POST['requirementsDelete'])));
		foreach($_POST['requirementsFilenames'] as $key => $filename) {
			unlink("../requirements/$filename");
		}
	}
	
	break;	
	
	case "delete":
	
	$con = new pdo_db('scholarships');
	
	$requirements = $con->getData("SELECT id, doc_title FROM requirements WHERE scholarship_id = ".$_POST['id'][0]);
	foreach ($requirements as $key => $requirement) {
		unlink("../requirements/".$requirement['doc_title']);
	}	
	
	$con->deleteData(array("id"=>implode(",",$_POST['id'])));	
	
	break;
	
}

function sendActivationCode($account_id,$con) {

$account = $con->getData("SELECT accounts.email, accounts.first_name, accounts.last_name, account_activations.activation_code FROM accounts LEFT JOIN account_activations ON accounts.id = account_activations.account_id WHERE accounts.id = $account_id");
$info = $account[0];
	
$to = $info['email'];

$subject = "INCATS Account Activation";

$headers = "From: incats2016@gmail.com\r\n";
$headers .= "Reply-To: incats2016@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<!DOCTYPE html>';
$message .=	'<html lang="en">';
$message .= '<body>';
$message .= '<p>Dear '.$info['first_name'].' '.$info['last_name'].',</p>';
$message .= '<p>Your activation code is <strong>'.$info['activation_code'].'</strong></p>';
$message .= '<p>Please proceed to the guidance counselor\'s office and provide your activation code to activate your account.</p>';
$message .= '<br><br>';
$message .= '<p>Thank you!</p>';
$message .= '<br>';
$message .= '<p>Administrator</p>';
$message .= '</body>';
$message .= '</html>';

mail($to,$subject,$message,$headers);
	
}

?>