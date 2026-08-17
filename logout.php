<?php
	require_once "inc/config.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    error_reporting( 0 );
	}

	session_unset();
	session_destroy();

	header( "Location: ?p=login" );
	exit;
?>
