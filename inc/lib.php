<?php

	function GenUniqueID() {
		$curr_ip = getHostByName(getHostName()); // @$_SERVER['REMOTE_ADDR'];
    	$curr_hostname = gethostname();

    	$sha1 = sha1( $curr_ip . $curr_hostname );
    	return $sha1;
	}

	function check_data( $ip, $hostname, $uid ) {
		global $link;
		$query = mysqli_query($link, "SELECT * FROM users WHERE (user_ip='".$ip."' AND user_hostname='".$hostname."' AND user_uid='".$uid."')");

		if(mysqli_num_rows($query) > 0) {
    		return true;
		}else{	
    		if (@!mysqli_query($link,$query)) {
        		//die('Error: ' . mysqli_error($link));
        		return false;
    		}
		}
	}

	function do_they_register_yet( $ip, $hostname, $uid ) {
		global $link;
		$query = mysqli_query( $link, "SELECT * FROM users WHERE (user_ip='".$ip."' AND user_hostname='".$hostname."' AND user_uid='".$uid."' AND user_loginname IS NOT NULL)" );

		if ( mysqli_num_rows( $query ) > 0 ) {
    		return true;
		} else {
			global $link;
    		if ( @!mysqli_query( $link, $query ) ) {
        		return false;
    		}
		}
	}

	function get_user_realname() {
		global $link;
		$curr_ip = getHostByName(getHostName()); // @$_SERVER['REMOTE_ADDR'];
    	$curr_hostname = gethostname();

		$sql = "SELECT * FROM users WHERE user_ip='$curr_ip' AND user_hostname='$curr_hostname';";
		$result = mysqli_query( $link, $sql );
		$row = mysqli_fetch_assoc( $result );
		
		$curr_username = $row['user_realname'];
		return $curr_username;
	}
?>