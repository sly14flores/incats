<?php

session_start();

if (isset($_SESSION['id'])) unset($_SESSION['id']);
if (isset($_SESSION['account_type'])) unset($_SESSION['account_type']);

header("location: index.php");

?>