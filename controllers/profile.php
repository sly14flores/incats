<?php

require_once '../db.php';

session_start();

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {

	case "list":
	
	$con = new pdo_db();
	$scholarships = $con->getData("SELECT id, application_type, program, course, college, year_level, school_year, evaluated, status, DATE_FORMAT(scholarships.status_date,'%M %e, %Y') date_approved, DATE_FORMAT(scholarships.evaluation_date,'%M %e, %Y') date_evaluated FROM scholarships WHERE account_id = '$_SESSION[id]'");
	
	foreach($scholarships as $key => $value) {
		$scholarships[$key]['evaluated'] = ($scholarships[$key]['evaluated'] != 0) ? "Yes" : "";
	}
	
	echo json_encode($scholarships);
	
	break;

	case "view":
	
	$con = new pdo_db();
	$perinfo = $con->getData("SELECT id, account_type, student_id, first_name, middle_name, last_name, gender, address, contact_no, birthdate, age, email FROM accounts WHERE id = '$_SESSION[id]'");
	
	if (($perinfo[0]['birthdate'] == "0000-00-00") || ($perinfo[0]['birthdate'] == "1970-01-01")) $perinfo[0]['birthdate'] = "";
	else $perinfo[0]['birthdate'] = date("m/d/Y",strtotime($perinfo[0]['birthdate']));
	
	if ($perinfo[0]['age'] == 0) $perinfo[0]['age'] = "";

	$accinfo = $con->getData("SELECT id, username, password, password re_type_password FROM accounts WHERE id = '$_SESSION[id]'");	
	
	$results = array("perinfo"=>$perinfo[0],"accinfo"=>$accinfo[0]);
	
	echo json_encode($results);
	
	break;
	
	case "update_perinfo":
	
	$_POST['perinfo']['birthdate'] = date("Y-m-d",strtotime($_POST['perinfo']['birthdate']));
	$_POST['perinfo']['built_in'] = 0;
	
	$con1 = new pdo_db('accounts');
	$perinfo = $con1->updateData($_POST['perinfo'],'id');

	$_POST['scholarinfo']['father_bday'] = date("Y-m-d",strtotime($_POST['scholarinfo']['father_bday']));	
	$_POST['scholarinfo']['mother_bday'] = date("Y-m-d",strtotime($_POST['scholarinfo']['mother_bday']));	
	
	$con2 = new pdo_db('scholars_infos');
	
	$checkInfo = $con2->getData("SELECT * FROM scholars_infos WHERE account_id = ".$_POST['perinfo']['id']);
	
	if (sizeof($checkInfo) == 0) {

		$scholarinfo1 = $con2->insertData(array("account_id"=>$_POST['perinfo']['id']));
		$scholarinfo_id = $con2->insertId;

		$scholarinfo2 = $con2->updateData($_POST['scholarinfo'],'id');	

	}
	
	
	break;
	
	case "update_accinfo":
	
	if (isset($_POST['re_type_password'])) unset($_POST['re_type_password']);
	
	$con = new pdo_db('accounts');
	$applicant = $con->updateData($_POST,'id');
	
	break;

	case "view_scholarship":

	$con = new pdo_db();
	$scholarship = $con->getData("SELECT id, application_type, programs, program, course, college, year_level, semester, school_year, status FROM scholarships WHERE id = $_POST[id]");
	
	$requirements = $con->getData("SELECT id, description, doc_rating, doc_title FROM requirements WHERE scholarship_id = ".$scholarship[0]['id']);
	
	$views = array("scholarship"=>$scholarship[0],"requirements"=>$requirements);
	
	echo json_encode($views);
	
	break;
	
	case "save_scholarship":
	
	$_POST['scholarship']['account_id'] = $_SESSION['id'];
	
	$con1 = new pdo_db('scholarships');
	$profile = $con1->insertData($_POST['scholarship']);
	
	foreach ($_POST['requirements'] as $key => $requirement) {
		if (isset($_POST['requirements'][$key]['id'])) unset($_POST['requirements'][$key]['id']);
		$_POST['requirements'][$key]['scholarship_id'] = $con1->insertId;
	}

	$con2 = new pdo_db('requirements');
	$requirements = $con2->insertDataMulti($_POST['requirements']);
	
	break;
	
	case "update_scholarship":
	
	$_POST['scholarship']['account_id'] = $_SESSION['id'];
	
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
	
	case "delete_scholarship":

	$con = new pdo_db('scholarships');
	
	$requirements = $con->getData("SELECT id, doc_title FROM requirements WHERE scholarship_id = ".$_POST['id'][0]);
	foreach ($requirements as $key => $requirement) {
		unlink("../requirements/".$requirement['doc_title']);
	}	
	
	$con->deleteData(array("id"=>implode(",",$_POST['id'])));
	
	break;

}

?>