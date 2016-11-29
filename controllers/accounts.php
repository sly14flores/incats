<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {
	
	case "list":
	
	$con = new pdo_db();
	$results = $con->getData("SELECT id, student_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) full_name, gender, contact_no, email, username, IF(is_activated = 1,'Active','Inactive') status FROM accounts WHERE account_type != 'Administrator'");
	
	echo json_encode($results);		
	
	break;
	
	case "view":
	
	$con = new pdo_db();
	$perinfo = $con->getData("SELECT id, student_id, first_name, middle_name, last_name, gender, birthdate, age, address, contact_no, email FROM accounts WHERE id = '$_POST[id]'");
	
	if ($perinfo[0]['birthdate'] == "0000-00-00") $perinfo[0]['birthdate'] = "";
	else $perinfo[0]['birthdate'] = date("m/d/Y",strtotime($perinfo[0]['birthdate']));
	
	if ($perinfo[0]['age'] == 0) $perinfo[0]['age'] = "";

	$accinfo = $con->getData("SELECT id, username, password, password re_type_password FROM accounts WHERE id = ".$perinfo[0]['id']);
	
	$results = array("perinfo"=>$perinfo[0],"accinfo"=>$accinfo[0]);
	
	echo json_encode($results);	
	
	break;
	
	case "delete":
	
	$con = new pdo_db('accounts');
	
	$scholarships = $con->getData("SELECT id FROM scholarships WHERE account_id = ".$_POST['id'][0]);
	$requirements = $con->getData("SELECT id, doc_title FROM requirements WHERE scholarship_id IN (".implode(",",$scholarships[0]).")");
	
	foreach ($requirements as $key => $requirement) {
		unlink("../requirements/".$requirement['doc_title']);
	}	
	
	$con->deleteData(array("id"=>implode(",",$_POST['id'])));	
	
	break;
	
}

?>