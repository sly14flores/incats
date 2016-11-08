<?php

$_POST = json_decode(file_get_contents('php://input'), true);

$dir = "../requirements";

move_uploaded_file($_FILES['file']['tmp_name'],"$dir/".$_GET['fn']);

?>