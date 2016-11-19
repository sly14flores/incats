<?php

session_start();

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {

case "info":

	$con = new pdo_db();
	$result = $con->getData("SELECT account_type, IF(built_in = 1,first_name,CONCAT(first_name, ' ', last_name)) name FROM accounts WHERE id = '$_SESSION[id]'");
	
	echo json_encode($result[0]);

break;

case "settings":
	
	$con = new pdo_db();
	$result = $con->getData("SELECT username, password, password re_type_password FROM accounts WHERE id = '$_SESSION[id]'");
	
	echo json_encode($result[0]);	
	
break;

case "update":

	$con = new pdo_db("accounts");
	if (isset($_POST['re_type_password'])) unset($_POST['re_type_password']);
	
	$_POST['id'] = $_SESSION['id'];
	
	$update = $con->updateData($_POST,'id');	

break;

case "lock":

	$con = new pdo_db();
	$results = $con->getData("SELECT username FROM accounts WHERE id = ".$_SESSION['id']." AND password = '".$_POST['pw']."'");	

	echo count($results);

break;
	
}

?>