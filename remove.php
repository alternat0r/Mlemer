<?php
	require_once "inc/lib.php";
	remove_user_from_db( get_current_user_id() );
	
	$curr_uid = GenUniqueID();
	unset( $_COOKIE["stayalive"] );
	setcookie( "stayalive", $curr_uid, time()-1 );

	
?>
<META http-equiv="refresh" content="0;URL=?p=home">;