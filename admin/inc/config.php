<?php
	//error_reporting(0);

	$user_name = "root";
	$password = "lkjhgfdsa";
	$database = "mlem_db";
	$server = "127.0.0.1";

	global $pg_title;
	global $pg_company;
	global $pg_about;

	$link = mysqli_connect( $server, $user_name, $password, $database );

	if ( !$link ) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;

	} else {

		$sql = "SELECT * FROM config";
		$result = mysqli_query( $link, $sql );
		$row = mysqli_fetch_assoc( $result );
		
		$pg_title = $row['pg_title'];
		$pg_company = $row['pg_company'];
		$pg_about = $row['pg_about'];
	}	
?>