<?php 

	ob_start();

	// Start our session
	session_start();


	$timezone = date_default_timezone_set("America/New_York");

	$connection = mysqli_connect("localhost", "root", "", "slotify");

	if (mysqli_connect_errno()) {
		echo "Failed to connect:" . mysqli_connect_errno();
	}

 ?>