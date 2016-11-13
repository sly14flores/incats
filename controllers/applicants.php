<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {
	
	case "list":
	
	$con = new pdo_db();
	$results = $con->getData("SELECT scholarships.id, accounts.student_id, CONCAT(accounts.first_name, ' ', accounts.middle_name, ' ', accounts.last_name) full_name, scholarships.program, scholarships.course, scholarships.college, scholarships.semester, scholarships.year_level, scholarships.school_year, scholarships.status FROM scholarships LEFT JOIN accounts ON scholarships.account_id = accounts.id WHERE application_type = 'New' AND account_type != 'Administrator'");
	
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

	$scholarship = $con->getData("SELECT id, application_type, programs, program, course, college, year_level, semester, school_year, status FROM scholarships WHERE id = ".$_POST['id']);	
	$requirements = $con->getData("SELECT id, description, doc_rating, doc_title FROM requirements WHERE scholarship_id = ".$_POST['id']);
	
	$results = array("scholarship"=>$scholarship[0],"requirements"=>$requirements);
	
	echo json_encode($results);
	
	break;
	
	case "update_scholarship":
	
	$con1 = new pdo_db('scholarships');
	$profile = $con1->updateData($_POST['scholarship'],'id');	
	
	$con2 = new pdo_db('requirements');		
	foreach($_POST['requirements'] as $key => $value) {
		if ($value['id'] == 0) {
			$_POST['requirements'][$key]['scholarship_id'] = $_POST['scholarship']['id'];
			unset($_POST['requirements'][$key]['id']);			
			$requirements = $con2->insertData($_POST['requirements'][$key]);
		}
	}
	
	if (count($_POST['requirementsDelete']) > 0) {		
		$con2->deleteData(array("id"=>implode(",",$_POST['requirementsDelete'])));
		foreach($_POST['requirementsFilenames'] as $key => $filename) {
			unlink("../requirements/$filename");
		}
	}
	
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