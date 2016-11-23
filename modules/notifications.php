<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

session_start();

$con = new pdo_db("dismiss_notifications");

$semester = array(1=>"1st Semester",2=>"2nd Semester");
$notifications = [];

switch ($_GET['r']) {

case "notifications":

if ($_SESSION['account_type'] == "Administrator") {
	$sql = "SELECT scholarships.id, accounts.student_id, CONCAT(accounts.first_name, ' ', accounts.middle_name, ' ', accounts.last_name) full_name, scholarships.program, scholarships.course, scholarships.college, scholarships.semester, scholarships.year_level, scholarships.school_year, scholarships.status, scholarships.application_type FROM scholarships LEFT JOIN accounts ON scholarships.account_id = accounts.id WHERE application_type IN ('New','Renewal') AND scholarships.status IN ('On-Process') AND account_type != 'Administrator' AND (SELECT COUNT(*) FROM dismiss_notifications WHERE dismiss_notifications.account_id = ".$_SESSION['id']." AND dismiss_notifications.scholarship_id = scholarships.id) = 0";
	$results = $con->getData($sql);

	foreach ($results as $key => $result) {
		if ($result['application_type'] == "New") $content = $result['full_name']." has applied for scholarship";
		else $content = $result['full_name']." has applied for scholarship renewal";
		$notifications[] = array("id"=>$result['id'],"content"=>$content);
	}
} else {
	/*
	**	Approved
	*/
	$sql = "SELECT scholarships.id, accounts.student_id, CONCAT(accounts.first_name, ' ', accounts.middle_name, ' ', accounts.last_name) full_name, scholarships.program, scholarships.course, scholarships.college, scholarships.semester, scholarships.year_level, scholarships.school_year, scholarships.status, scholarships.application_type FROM scholarships LEFT JOIN accounts ON scholarships.account_id = accounts.id WHERE scholarships.account_id = $_SESSION[id] AND scholarships.application_type IN ('New','Renewal') AND scholarships.status IN ('Approved') AND (SELECT COUNT(*) FROM dismiss_notifications WHERE dismiss_notifications.account_id = ".$_SESSION['id']." AND dismiss_notifications.scholarship_id = scholarships.id) = 0";
	$results = $con->getData($sql);

	foreach ($results as $key => $result) {
		if ($result['application_type'] == "New") $content = "Your scholarship application for ".$semester[$result['semester']]." SY: ".$result['school_year']." was approved";
		else $content = "Your scholarship renewal for ".$semester[$result['semester']]." SY: ".$result['school_year']." was approved";
		$notifications[] = array("id"=>$result['id'],"content"=>$content);
	}	
}

echo json_encode($notifications);

break;

case "dismiss":

$dismiss = $con->insertData(array("account_id"=>$_SESSION['id'],"scholarship_id"=>$_POST['id']));

break;

}

?>