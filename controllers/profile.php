<?php

require_once '../db.php';

session_start();

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {

	case "view":
	
	$con = new pdo_db();
	$result = $con->getData("SELECT *, password re_type_password FROM accounts WHERE id = '$_SESSION[id]'");
	
	if ($result[0]['birthdate'] == "0000-00-00") $result[0]['birthdate'] = "";
	else $result[0]['birthdate'] = date("m/d/Y",strtotime($result[0]['birthdate']));
	
	if ($result[0]['age'] == 0) $result[0]['age'] = "";
	
	echo json_encode($result[0]);
	
	break;
	
	case "update":
	
	$_POST['birthdate'] = date("Y-m-d",strtotime($_POST['birthdate']));
	$_POST['built_in'] = 0;
	if (isset($_POST['re_type_password'])) unset($_POST['re_type_password']);
	
	$con = new pdo_db('accounts');
	$applicant = $con->updateData($_POST,'id');
	
	break;	

}

?>