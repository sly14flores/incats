<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

session_start();

$con = new pdo_db();

if ($_SESSION['account_type'] == "Administrator") {
	$sql = "SELECT scholarships.id, accounts.student_id, CONCAT(accounts.first_name, ' ', accounts.middle_name, ' ', accounts.last_name) full_name, scholarships.program, scholarships.course, scholarships.college, scholarships.semester, scholarships.year_level, scholarships.school_year, scholarships.status FROM scholarships LEFT JOIN accounts ON scholarships.account_id = accounts.id WHERE application_type IN ('New','Renewal') AND scholarships.status IN ('On-Process') AND account_type != 'Administrator'";
	$results = $con->getData($sql);
	
	$notifications = [];
	foreach ($results as $key => $result) {
		$notifications[] = array("content"=>$result['full_name']);
	}
} else {
	
}

echo json_encode($notifications);

?>