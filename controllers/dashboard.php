<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {
	
	case "events_announcements":
	
		$con = new pdo_db();				
		
		$events = $con->getData("SELECT * FROM events ORDER BY id DESC LIMIT 5");
		foreach ($events as $key => $event) {
			$events[$key]['event_date'] = date("F j, Y",strtotime($events[$key]['event_date']));
		}
		
		$announcements = $con->getData("SELECT * FROM announcements ORDER BY id DESC LIMIT 5");
		foreach ($announcements as $key => $announcement) {
			$announcements[$key]['announcement_date'] = date("F j, Y",strtotime($announcements[$key]['announcement_date']));
		}		
		
		$memos = $con->getData("SELECT * FROM memos ORDER BY id DESC LIMIT 5");
		
		$events_announcements = array("events"=>$events,"announcements"=>$announcements,"memos"=>$memos);
		
		echo json_encode($events_announcements);
	
	break;
	
	case "add_event":
		
		$con = new pdo_db("events");
		
		$_POST['event_date'] = "CURRENT_TIMESTAMP";
		$event = $con->insertData($_POST);
		
	break;
	
	case "add_announcement":
	
		$con = new pdo_db("announcements");
		
		$_POST['announcement_date'] = "CURRENT_TIMESTAMP";
		$event = $con->insertData($_POST);
	
	break;
	
	case "ptResults":

		$con = new pdo_db();
		$results = $con->getData("SELECT accounts.student_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) full_name, testing_results.rating FROM testing_results LEFT JOIN accounts ON testing_results.scholar_id = accounts.id WHERE testing_results.testing_type = 'PT'");
		
		echo json_encode($results);
			
	break;
	
	case "catResults":

		$con = new pdo_db();
		$results = $con->getData("SELECT accounts.student_id, CONCAT(first_name, ' ', middle_name, ' ', last_name) full_name, testing_results.rating FROM testing_results LEFT JOIN accounts ON testing_results.scholar_id = accounts.id WHERE testing_results.testing_type = 'CAT'");
	
		echo json_encode($results);	
	
	break;
	
	case "edit_event":
	
		$con = new pdo_db();
		$result = $con->getData("SELECT * FROM events WHERE id = $_POST[id]");
		
		echo json_encode($result[0]);
	
	break;
	
	case "update_event":
	
		$con = new pdo_db("events");
		$event = $con->updateData($_POST,'id');
		
		echo "";
	
	break;
	
	case "delete_event":
	
		$con = new pdo_db("events");
		$con->deleteData(array("id"=>implode(",",$_POST['id'])));			
		
		echo "";
		
	break;
	
	case "edit_announcement":
	
		$con = new pdo_db();
		$result = $con->getData("SELECT * FROM announcements WHERE id = $_POST[id]");
		
		echo json_encode($result[0]);	
	
	break;
	
	case "update_announcement":
	
		$con = new pdo_db("announcements");
		$announcement = $con->updateData($_POST,'id');
		
		echo "";
	
	break;
	
	case "delete_announcement":
	
		$con = new pdo_db("announcements");
		$con->deleteData(array("id"=>implode(",",$_POST['id'])));			
		
		echo "";	
	
	break;
	
	case "upload_memo":
	
	$dir = "../memos";
	
	move_uploaded_file($_FILES['file']['tmp_name'],"$dir/".$_GET['fn']);
	
	break;
	
	case "add_memo":
	
	$con = new pdo_db('memos');
	$memo = $con->insertData(array("title"=>$_POST['title'],"file"=>$_POST['fn'],"memo_date"=>"CURRENT_TIMESTAMP"));		
	
	break;
	
}

?>