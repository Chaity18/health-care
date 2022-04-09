<?php
session_start();
require_once '../config/config.php';
if ($conn) {
	$username = $_REQUEST['username'];
	$password = base64_encode(hash('sha256', $_REQUEST['password']));
	$query = "SELECT * FROM admin_users WHERE username='".$username."' AND password='".$password."'";
	$selectQuery = $conn->prepare($query);
	$data = $selectQuery->execute();
	$rowCount = $selectQuery->rowCount();
	if ($rowCount > 0) {
		$days = 365;
		setcookie("user", $username, time()+(86400 * $days)	, "/"); 
		echo "<script>window.location.href='../html/dashboard.php'</script>";
	}else{
		echo "<script>alert('please log in using username and password');
  				window.location.href =   '../html/index.php';
  				</script>";
	}
}else {
	throw new Exception("failed to connect database", 500);
}