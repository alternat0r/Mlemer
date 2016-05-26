<?php
	require_once "inc/config.php";
	
	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    error_reporting( 0 );
	}
 	if(isset($_SESSION['login_user'])) unset($_SESSION['login_user']);
 	header('Refresh: 1; URL = ?p=login');

 ?>
