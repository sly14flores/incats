<?php

require_once '../db.php';

$_POST = json_decode(file_get_contents('php://input'), true);

switch ($_GET['r']) {
	
	case "events_announcements":
	
		$con = new pdo_db();				
		
		$events = $con->getData("SELECT * FROM events ORDER BY id DESC");
		foreach ($events as $key => $event) {
			$events[$key]['event_date'] = date("F j, Y",strtotime($events[$key]['event_date']));
		}
		
		$announcements = $con->getData("SELECT * FROM announcements ORDER BY id DESC");
		foreach ($announcements as $key => $announcement) {
			$announcements[$key]['announcement_date'] = date("F j, Y",strtotime($announcements[$key]['announcement_date']));
		}		
		
		$events_announcements = array("events"=>$events,"announcements"=>$announcements);
		
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
	
}

?>