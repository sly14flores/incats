<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {
	
	case "list":
	
		$con = new pdo_db();
		$results = $con->getData("SELECT testing_results.id, accounts.student_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) full_name, testing_results.testing_type, testing_results.rating FROM testing_results LEFT JOIN accounts ON testing_results.scholar_id = accounts.id");
	
		echo json_encode($results);
	
	break;
	
	case "view":
	
		$con = new pdo_db();
		$result = $con->getData("SELECT testing_results.id, accounts.id scholar_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) full_name, testing_results.testing_type, testing_results.rating FROM testing_results LEFT JOIN accounts ON testing_results.scholar_id = accounts.id WHERE testing_results.id = ".$_POST['id']);
		
		echo json_encode($result[0]);
	
	break;
	
	case "students":
		
		$con = new pdo_db();
		$results = $con->getData("SELECT id, CONCAT(first_name, ' ', middle_name, ' ', last_name) full_name FROM accounts WHERE account_type = 'Applicant'");
		
		echo json_encode($results);
		
	break;
	
	case "add_testing":
		
		$con = new pdo_db("testing_results");
		$_POST['testing_date'] = "CURRENT_TIMESTAMP";
		$testing_result = $con->insertData($_POST);
	
	break;
	
	case "update_testing":
	
		$con = new pdo_db("testing_results");
		$testing_result = $con->updateData($_POST,'id');
	
	break;
	
	case "delete":
		
		$con = new pdo_db("testing_results");
		$con->deleteData(array("id"=>implode(",",$_POST['id'])));
		
	break;
	
}

?>