<?php
	
	function GenUniqueID() {
		$curr_ip = getHostByName(getHostName()); // @$_SERVER['REMOTE_ADDR'];
    	$curr_hostname = gethostname();

    	$sha1 = sha1( $curr_ip . $curr_hostname );
    	return $sha1;
	}

	function GetCompanyName() {
		global $link;
		$sql = "SELECT * FROM config";
  		$result = mysqli_query( $link, $sql );
  		$row = mysqli_fetch_assoc( $result );
 
  		$pg_company = $row['pg_company'];
  		return $pg_company;
	}

	function GetProductName() {
		global $link;
		$sql = "SELECT * FROM config";
  		$result = mysqli_query( $link, $sql );
  		$row = mysqli_fetch_assoc( $result );
 
  		$pg_ret = $row['pg_product'];
  		return $pg_ret;
	}

	function GetTitle() {
		global $link;
		$sql = "SELECT * FROM config";
  		$result = mysqli_query( $link, $sql );
  		$row = mysqli_fetch_assoc( $result );
 
  		$pg_ret = $row['pg_title'];
  		return $pg_ret;
	}

	function GetAbout() {
		global $link;
		$sql = "SELECT * FROM config";
  		$result = mysqli_query( $link, $sql );
  		$row = mysqli_fetch_assoc( $result );
 
  		$pg_ret = $row['pg_about'];
  		return $pg_ret;
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
			if ( isset( $_COOKIE["stayalive"] ) )  {
				if ( $_COOKIE["stayalive"] == GenUniqueID() ) {
    				return true;
    			}
    		}
		} else {
			global $link;
    		if ( @!mysqli_query( $link, $query ) ) {
        		return false;
    		}
		}
	}

	function get_current_user_realname() {
		global $link;
		$curr_ip = getHostByName(getHostName()); // @$_SERVER['REMOTE_ADDR'];
    	$curr_hostname = gethostname();

		$sql = "SELECT * FROM users WHERE user_ip='$curr_ip' AND user_hostname='$curr_hostname';";
		$result = mysqli_query( $link, $sql );
		$row = mysqli_fetch_assoc( $result );
		
		$curr_username = $row['user_realname'];
		return $curr_username;
	}

	function get_current_username() {
		global $link;
		$curr_ip = getHostByName(getHostName()); // @$_SERVER['REMOTE_ADDR'];
    	$curr_hostname = gethostname();

		$sql = "SELECT * FROM users WHERE user_ip='$curr_ip' AND user_hostname='$curr_hostname';";
		$result = mysqli_query( $link, $sql );
		$row = mysqli_fetch_assoc( $result );
	
		$curr_username = $row['user_loginname'];
		return $curr_username;
	}

	function get_current_userpassword() {
		global $link;
		$curr_ip = getHostByName(getHostName()); // @$_SERVER['REMOTE_ADDR'];
    	$curr_hostname = gethostname();

		$sql = "SELECT * FROM users WHERE user_ip='$curr_ip' AND user_hostname='$curr_hostname';";
		$result = mysqli_query( $link, $sql );
		$row = mysqli_fetch_assoc( $result );
	
		$curr_username = $row['user_password'];
		return $curr_username;
	}

	function update_config( $pg_product, $pg_title, $pg_company, $pg_about ) {
		global $link;

		/*$sql = "SELECT * FROM config";
		$result = mysqli_query( $link, $sql );
		$row = mysqli_fetch_assoc( $result );
		$pg_product = $row['pg_product'];*/
		//mysqli_query( $link, "UPDATE config SET pg_product='$pg_product';");
		/*if ( !empty( $pg_product ) ) {
			
		} else {
			mysqli_query( $link, "UPDATE config SET pg_product='Mlemer';");
		}*/


		mysqli_query( $link, "UPDATE config SET pg_product='$pg_product', pg_title='$pg_title', pg_company='$pg_company', pg_about='$pg_about';");
	}

	function error_msg( $type, $msg ) {
		if ( isset( $msg ) ) {
			if ( $type == "success" ) {
				$type = "success";
			} elseif ( $type == "danger" ) {
				$type = "danger";
			} elseif ( $type == "info" ) {
				$type = "info";
			} elseif ( $type == "warning" ) {
				$type = "warning";
			} else {
				$type = "info";
			}

			$final_msg = "<div class=\"alert alert-".$type." alert-dismissible\" role=\"alert\">";
  			$final_msg .= " 	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
  			$final_msg .= "		<strong>UPDATE!</strong> " . $msg;
			$final_msg .= "</div>";


			return $final_msg;
		}
	}
?>
