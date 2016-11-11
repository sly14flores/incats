<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {
	
	case "list":
	
	$con = new pdo_db();
	$results = $con->getData("SELECT scholarships.id, accounts.student_id, CONCAT(accounts.first_name, ' ', accounts.middle_name, ' ', accounts.last_name) full_name, scholarships.program, scholarships.course, scholarships.college, scholarships.semester, scholarships.year_level, scholarships.school_year FROM scholarships LEFT JOIN accounts ON scholarships.account_id = accounts.id WHERE application_type = 'New' AND account_type != 'Administrator'");
	
	echo json_encode($results);	
	
	break;
	
	case "Save":
	
	if ($_POST['birthdate'] != "0000-00-00") $_POST['birthdate'] = date("Y-m-d",strtotime($_POST['birthdate']));

	if (isset($_POST['re_type_password'])) unset($_POST['re_type_password']);
	
	$con = new pdo_db('accounts');
	$applicant = $con->insertData($_POST);
	
	break;
	
	case "Update":
	
	$_POST['birthdate'] = date("Y-m-d",strtotime($_POST['birthdate']));
	
	$con = new pdo_db('accounts');
	$applicant = $con->updateData($_POST,'id');
	
	break;
	
	case "view":
	
	$con = new pdo_db();
	$perinfo = $con->getData("SELECT scholarships.id, scholarships.account_id, accounts.account_type, accounts.student_id, accounts.first_name, accounts.middle_name, accounts.last_name, accounts.gender, accounts.address, accounts.contact_no, birthdate, accounts.age, accounts.email FROM scholarships LEFT JOIN accounts ON scholarships.account_id = accounts.id WHERE scholarships.id = '$_POST[id]'");
	
	if ($perinfo[0]['birthdate'] == "0000-00-00") $perinfo[0]['birthdate'] = "";
	else $perinfo[0]['birthdate'] = date("m/d/Y",strtotime($perinfo[0]['birthdate']));
	
	if ($perinfo[0]['age'] == 0) $perinfo[0]['age'] = "";

	$accinfo = $con->getData("SELECT id, username, password, password re_type_password FROM accounts WHERE id = ".$perinfo[0]['account_id']);	

	$scholarship = $con->getData("SELECT id, application_type, programs, program, course, college, year_level, semester, school_year FROM scholarships WHERE account_id = ".$perinfo[0]['account_id']." ORDER BY id DESC LIMIT 1");	
	$requirements = $con->getData("SELECT id, description, doc_rating, doc_title FROM requirements WHERE scholarship_id = ".$scholarship[0]['id']);
	
	$results = array("perinfo"=>$perinfo[0],"accinfo"=>$accinfo[0],"scholarship"=>$scholarship[0],"requirements"=>$requirements);
	
	echo json_encode($results);
	
	break;
	
	case "delete":
	
	$con = new pdo_db('scholarships');
	
	$requirements = $con->getData("SELECT id, doc_title FROM requirements WHERE scholarship_id = ".$_POST['id'][0]);
	foreach ($requirements as $key => $requirement) {
		unlink("../requirements/".$requirement['doc_title']);
	}	
	
	$con->deleteData(array("id"=>implode(",",$_POST['id'])));	
	
	break;
	
}

?>