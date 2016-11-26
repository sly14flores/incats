<?php

$_POST = json_decode(file_get_contents('php://input'), true);

require_once 'db.php';

switch ($_GET['r']) {
	case "login":
	$con = new pdo_db();
	$sql = "SELECT id, first_name, middle_name, last_name, account_type FROM accounts WHERE username = '".$_POST['username']."' AND password = '".$_POST['password']."'";
	$account = $con->getData($sql);
	if (($con->rows) > 0) {
		session_start();
		$_SESSION['id'] = $account[0]['id'];
		$_SESSION['account_type'] = $account[0]['account_type'];
		$_SESSION['timeout'] = false;
		echo json_encode($account[0]);
	} else {
		echo '{ "id":0 }';
	}
	break;
}

?>