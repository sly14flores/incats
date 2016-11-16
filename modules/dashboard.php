<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

session_start();

$con = new pdo_db();

switch ($_GET['r']) {

	case "new_scholars":

	$con = new pdo_db();
	$results = $con->getData("SELECT CONCAT(accounts.first_name, ' ', accounts.middle_name, ' ', accounts.last_name) full_name, scholarships.course, scholarships.college, scholarships.year_level, scholarships.semester, scholarships.school_year, scholarships.status FROM scholarships LEFT JOIN accounts ON scholarships.account_id = accounts.id WHERE application_type = 'New' AND account_type != 'Administrator'");
		
	foreach ($results as $key => $result) {
		$results[$key]['on_process'] = ($result['status'] == "On-Process") ? true : false;
		$results[$key]['pending'] =  ($result['status'] == "Pending") ? true : false;
		$results[$key]['approved'] =  ($result['status'] == "Approved") ? true : false;
		$results[$key]['disapproved'] =  ($result['status'] == "Disapproved") ? true : false;
	}
		
	echo json_encode($results);		
	
	break;
	
	case "scholars":

	$con = new pdo_db();
	$results = $con->getData("SELECT CONCAT(accounts.first_name, ' ', accounts.middle_name, ' ', accounts.last_name) full_name, scholarships.course, scholarships.college, scholarships.year_level, scholarships.semester, scholarships.school_year, scholarships.status FROM scholarships LEFT JOIN accounts ON scholarships.account_id = accounts.id WHERE application_type = 'New' AND scholarships.status = 'Approved' AND account_type != 'Administrator'");
		
	echo json_encode($results);		
	
	break;	
	
}

?>