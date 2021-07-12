<?php

	session_start();
	
	$host = "localhost";
	$username = "root";
	$password = "";
	$database = "barcode_attendance";

	// $host = "sql6.freemysqlhosting.net";
	// $username = "sql6409979";
	// $password = "e1Eq68B2TN";
	// $database = "sql6409979";

	$connection = new mysqli($host, $username, $password, $database);

?>