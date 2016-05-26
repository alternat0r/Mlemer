<?php
	require_once "inc/lib.php";
	require_once "inc/config.php";
	
	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}
	
	$user_id = get_current_user_id();
	remove_user_from_db( $user_id );
	remove_user_from_answer( $user_id );

	$curr_uid = GenUniqueID();
	unset( $_COOKIE["stayalive"] );
	setcookie( "stayalive", $curr_uid, time()-1 );

	
?>
<META http-equiv="refresh" content="0;URL=?p=home">;
