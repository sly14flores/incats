<?php

require_once '../db.php';

session_start();

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {

	case "view":
	
	$con = new pdo_db();
	$perinfo = $con->getData("SELECT id, account_type, student_id, first_name, middle_name, last_name, gender, address, contact_no, birthdate, age, email FROM accounts WHERE id = '$_SESSION[id]'");
	
	if ($perinfo[0]['birthdate'] == "0000-00-00") $perinfo[0]['birthdate'] = "";
	else $perinfo[0]['birthdate'] = date("m/d/Y",strtotime($perinfo[0]['birthdate']));
	
	if ($perinfo[0]['age'] == 0) $perinfo[0]['age'] = "";

	$accinfo = $con->getData("SELECT id, username, password, password re_type_password FROM accounts WHERE id = '$_SESSION[id]'");	
	
	$results = array("perinfo"=>$perinfo[0],"accinfo"=>$accinfo[0]);
	
	echo json_encode($results);
	
	break;
	
	case "update_perinfo":
	
	$_POST['birthdate'] = date("Y-m-d",strtotime($_POST['birthdate']));
	$_POST['built_in'] = 0;
	
	$con = new pdo_db('accounts');
	$applicant = $con->updateData($_POST,'id');
	
	break;
	
	case "update_accinfo":
	
	if (isset($_POST['re_type_password'])) unset($_POST['re_type_password']);
	
	$con = new pdo_db('accounts');
	$applicant = $con->updateData($_POST,'id');
	
	break;

	case "save_scholarship":
	
	if (isset($_POST['scholarship']['programs'])) unset($_POST['scholarship']['programs']);
	
	$_POST['scholarship']['account_id'] = $_SESSION['id'];
	
	$con1 = new pdo_db('scholarships');
	$profile = $con1->insertData($_POST['scholarship']);
	
	foreach ($_POST['requirements'] as $key => $requirement) {
		$_POST['requirements'][$key]['scholarship_id'] = $con1->insertId;
	}

	$con2 = new pdo_db('requirements');
	$requirements = $con2->insertDataMulti($_POST['requirements']);
	
	break;

}

?>