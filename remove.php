<?php
	require_once "inc/lib.php";
	$curr_uid = GenUniqueID();
	unset( $_COOKIE["stayalive"] );
	setcookie( "stayalive", $curr_uid, time()-1 );
?>
<META http-equiv="refresh" content="0;URL=?p=home">;