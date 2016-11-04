<?php

session_start();

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {

case "info":

	$con = new pdo_db();
	$result = $con->getData("SELECT IF(built_in = 1,first_name,CONCAT(first_name, ' ', last_name)) name FROM accounts WHERE id = '$_SESSION[id]'");
	
	echo json_encode($result[0]);

break;	
	
}

?>