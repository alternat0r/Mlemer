<?php
	require_once "inc/lib.php";
	require_once "inc/config.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}

	require_login();

	if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
		header( "Location: ?p=account" );
		exit;
	}

	csrf_verify();

	$user_id = current_user_id();
	remove_user_from_db( $user_id );
	remove_user_from_answer( $user_id );

	session_unset();
	session_destroy();

	header( "Location: ?p=home" );
	exit;
?>
