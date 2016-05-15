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
		$curr_ip = getHostByName( getHostName() ); // @$_SERVER['REMOTE_ADDR'];
    	$curr_hostname = gethostname();

		$sql = "SELECT * FROM users WHERE user_ip='$curr_ip' AND user_hostname='$curr_hostname';";
		$result = mysqli_query( $link, $sql );
		$row = mysqli_fetch_assoc( $result );
	
		$curr_username = $row['user_loginname'];
		return $curr_username;
	}

	function get_current_user_id() {
		global $link;
		$curr_ip = getHostByName( getHostName() ); // @$_SERVER['REMOTE_ADDR'];
    	$curr_hostname = gethostname();

		$sql = "SELECT * FROM users WHERE user_ip='$curr_ip' AND user_hostname='$curr_hostname';";
		$result = mysqli_query( $link, $sql );
		$row = mysqli_fetch_assoc( $result );
	
		$curr_userid = $row['id'];
		return $curr_userid;
	}

	function get_current_userpassword() {
		global $link;
		$curr_ip = getHostByName( getHostName() ); // @$_SERVER['REMOTE_ADDR'];
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

	function error_msg( $type, $title, $msg, $dismissible ) {
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

			if ( $dismissible == "1" ) {
				$final_msg = "<br/>";
				$final_msg .= "<div class=\"popup alert alert-".$type." alert-dismissible\" role=\"alert\">";
	  			$final_msg .= " 	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
	  			$final_msg .= "		<strong>".$title."</strong> " . $msg;
				$final_msg .= "</div>";
			} else {
				$final_msg = "<br/><div class=\"panel panel-".$type."\">";
				$final_msg .= "	<div class=\"panel-heading\">";
				$final_msg .= "		<h3 class=\"panel-title\">".$msg."</h3>";
				$final_msg .= "	</div>";
				$final_msg .= "</div>";
			}

			return $final_msg;
		}
	}

	/**
	 * truncate a string provided by the maximum limit without breaking a word
	 * @param string $str
	 * @param integer $maxlen
	 * @return string
	 */
	function shorten($str, $maxlen) {
	    if (strlen($str) <= $maxlen) return $str;

	    $newstr = substr($str, 0, $maxlen);
	    if (substr($newstr, -1, 1) != ' ') $newstr = substr($newstr, 0, strrpos($newstr, " "));

	    return $newstr . "...";
	}

	function count_total_available_question() {
		global $link;
		$sql = "SELECT DISTINCT id FROM questionaire";
		$result = mysqli_query( $link, $sql );
		$q_count = mysqli_num_rows( $result );
		printf( "%d", $q_count );
	}

	function count_total_question_taken() {
		global $link;
		$sql = "SELECT DISTINCT id FROM users_answer";
		$result = mysqli_query( $link, $sql );
		$q_count = mysqli_num_rows( $result );
		printf( "%d", $q_count );
	}

	function count_registered_user() {
		global $link;
		$sql = "SELECT * FROM users";
      	$user_count = "";
		$result = mysqli_query( $link, $sql );
		while( $row = @mysqli_fetch_assoc( $result ) ) {
			$user_count++;
		}
		return $user_count;
	}

	function get_last_answer( $exer_id, $qid ) {
		global $link;
		$user_id = get_current_user_id();

		$query = mysqli_query( $link, "SELECT * FROM users_answer WHERE (user_id='".$user_id."' AND user_last_exercise_id='".$exer_id."' AND user_last_qid='".$qid."' )" );
  		$row = mysqli_fetch_assoc( $query );
  		$answer_db = $row['user_last_answer'];
  		return $answer_db;
	}

	function check_last_answer_if_correct_return_point( $exer_id, $qid ) {
		global $link;
		$user_id = get_current_user_id();

		$query = mysqli_query( $link, "SELECT * FROM users_answer WHERE (user_id='".$user_id."' AND user_last_exercise_id='".$exer_id."' AND user_last_qid='".$qid."' )" );
  		$row = mysqli_fetch_assoc( $query );
  		$answer_db = $row['correct'];

  		if ( $answer_db == "yes" ) {
  			return get_quest_point( $exer_id, $qid);
  		} else {
  			return "0";
  		}
	}

	function check_last_answer_is_correct_or_not( $exer_id, $qid ) {
		global $link;
		$user_id = get_current_user_id();

		$query = mysqli_query( $link, "SELECT * FROM users_answer WHERE (user_id='".$user_id."' AND user_last_exercise_id='".$exer_id."' AND user_last_qid='".$qid."' )" );
  		$row = mysqli_fetch_assoc( $query );
  		$answer_db = $row['correct'];
		return $answer_db;
	}

	function calculate_point() {
		/* TODO:
			Calculation is based on the following:
				- How many correct answer on per-exercise.
				- Sum up all correct answer based on pre-defined worth point.
				- Every question may have different point.

				Example:
					Correct answer on Exercise x 5
					
					Question 1 = 10 point
					Question 2 = 5  point
					Question 3 = 1  point
					Question 4 = 2  point
					Question 5 = 15 point
				
					Total Scored: 43 point
		*/
		global $link;
		$sql = "SELECT * FROM users_answer";
      	$user_count = 0;
      	$total = 0;
		$result = mysqli_query( $link, $sql );
		while( $row = @mysqli_fetch_assoc( $result ) ) {
			$total_correct = $row['correct'];
			if ( $total_correct == "yes" ) {
				$user_count++;
				$exer_id = $row['user_last_exercise_id'];
				$qid = $row['user_last_qid'];				
				$total = $total + check_last_answer_if_correct_return_point( $exer_id, $qid );
			}
		}
		//echo "COUNT: ".$user_count."----> ".$total."<br/>";
		return $total;

	}

	function get_perplayer_total_point( $user_id ) {
		global $link;
		$sql = "SELECT * FROM users_answer WHERE user_id='$user_id';";
      	$user_count = "";
      	$total = "";
		$result = mysqli_query( $link, $sql );
		$total = "0"; //default
		while( $row = @mysqli_fetch_assoc( $result ) ) {
			$user_count++;
			$total_correct = $row['correct'];
			$exer_id = $row['user_last_exercise_id'];
			$qid = $row['user_last_qid'];
			if ( $total_correct == "yes" ) {
				$total = $total + check_peruser_last_answer_if_correct_return_point( $user_id, $exer_id, $qid );
			} 
		}
		return $total;
			
	}

	function save_user_point( $user_id ) {
		global $link;
		$user_point = get_perplayer_total_point( $user_id );
		if ( !mysqli_query( $link, "UPDATE users SET user_point='$user_point' WHERE id='$user_id';") ) {
			echo mysqli_error( $link );
		}
	}

	function check_peruser_last_answer_if_correct_return_point( $user_id, $exer_id, $qid ) {
		global $link;
		//$user_id = get_current_user_id();

		$query = mysqli_query( $link, "SELECT * FROM users_answer WHERE (user_id='".$user_id."' AND user_last_exercise_id='".$exer_id."' AND user_last_qid='".$qid."' )" );
  		$row = mysqli_fetch_assoc( $query );
  		$answer_db = $row['correct'];

  		if ( $answer_db == "yes" ) {
  			return get_quest_point( $exer_id, $qid);
  		} else {
  			return "0";
  		}
	}

	function count_how_many_correct_answer( $user_id, $exer_id, $quest_id ) {
		global $link;
		$sql = "SELECT * FROM users_answer";
      	$user_count = "";
		$result = mysqli_query( $link, $sql );
		while( $row = @mysqli_fetch_assoc( $result ) ) {
			$user_count++;
			$total_correct = $row['correct'];
		}
		return $user_count;
	}

	/*
		Get point number from specific question id.
		Every question may have different point.
	*/
	function get_quest_point( $exer_id, $quest_id ) {
		global $link;
		$user_id = get_current_user_id();

		$query = mysqli_query( $link, "SELECT * FROM questionaire WHERE (exercise_id='".$exer_id."' AND id='".$quest_id."' )" );
  		$row = mysqli_fetch_assoc( $query );
  		$qpoint = $row['point'];
  		return $qpoint;
	}

	function remove_user_from_db( $user_id ) {
		global $link;
		$sql = "DELETE FROM users WHERE id='$user_id'";

		if ( mysqli_query( $link, $sql ) ) {
		    //echo "User deleted successfully";
		} else {
		    //echo "Error deleting record: " . mysqli_error($conn);
		}
	}

	function remove_user_from_answer( $user_id ) {
		global $link;
		$sql = "DELETE FROM users_answer WHERE user_id='$user_id'";

		if ( mysqli_query( $link, $sql ) ) {
		    //echo "User deleted successfully";
		} else {
		    //echo "Error deleting record: " . mysqli_error($conn);
		}
	}

	function admin_add_category( $cat_name, $cat_description ) {
		global $link;
		$sql = "INSERT INTO category (category_name,category_description) VALUES  ('$cat_name', '$cat_description');";

		if ( !mysqli_query( $link, $sql ) ) {
			echo error_msg("danger", "ERROR:", mysqli_error( $link ), "1");
		} else {
			echo error_msg("success", "SUCCESS", "New category has been added.", "1");
		}
	}
?>
