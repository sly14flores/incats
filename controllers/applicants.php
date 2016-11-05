<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {
	
	case "list":
	
	$con = new pdo_db();
	$results = $con->getData("SELECT id, student_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) full_name, gender, contact_no FROM accounts WHERE account_type != 'Administrator'");
	
	echo json_encode($results);	
	
	break;
	
	case "Save":
	
	if ($_POST['birthdate'] != "0000-00-00") $_POST['birthdate'] = date("Y-m-d",strtotime($_POST['birthdate']));

	if (isset($_POST['re_type_password'])) unset($_POST['re_type_password']);
	
	$con = new pdo_db('accounts');
	$applicant = $con->insertData($_POST);
	
	break;
	
	case "Update":
	
	$_POST['birthdate'] = date("Y-m-d",strtotime($_POST['birthdate']));
	
	$con = new pdo_db('accounts');
	$applicant = $con->updateData($_POST,'id');
	
	break;
	
	case "view":
	
	$con = new pdo_db();
	$result = $con->getData("SELECT id, student_id, first_name, middle_name, last_name, gender, birthdate, age, address, contact_no, username, password, password re_type_password FROM accounts WHERE id = '$_POST[id]'");
	
	$result[0]['birthdate'] = date("m/d/Y",strtotime($result[0]['birthdate']));
	
	echo json_encode($result[0]);
	
	break;
	
	case "delete":
	
	$con = new pdo_db('accounts');
	$delete = $con->deleteData($_POST);	
	
	break;
	
}

?>