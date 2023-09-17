<?php
	include("../includes/config.php");
	session_start();
	if(isset($_SESSION['admin_login']) || isset($_SESSION['manufacturer_login']) || isset($_SESSION['retailer_login'])) {
		session_destroy();
		echo "<h3 style=\"color:#8127ca\">Log Out Successful</h3>";
//		echo "<h3 style=\"color:#8127ca\">You will be redirected to Login page in 3 seconds...</h3>";
		header('Refresh:2;url="index.php"');
	}
	else {
			header('Location:../index.php');
	}
?>