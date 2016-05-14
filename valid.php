<?php
	require_once "inc/config.php";
	require_once "inc/lib.php";

	if ( isset( $_REQUEST['answer'] ) && isset( $_REQUEST['qid'] ) && isset( $_REQUEST['eid'] ) ) {
		$answer = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['answer'] ) );
		$exer_id = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['eid'] ) );
		$quest_id = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['qid'] ) );

		if ( check_answer_on_db( $quest_id, $answer ) == true ) {
			echo "	<td style=\"vertical-align: middle;\"><div class=\"glyphicon glyphicon-ok-circle\"  style=\"color:#01DF3A\" ></div></td>";
		} else {
			echo "	<td style=\"vertical-align: middle;\"><div class=\"glyphicon glyphicon-remove-circle\"  style=\"color:#FF0040\" ></div></td>";
		}
		store_last_answer( $exer_id, $quest_id, $answer );
	}

	function check_answer_on_db( $quest_id, $answer ) {
		global $link;
		$sql = "SELECT * FROM questionaire WHERE id='$quest_id';";
  		$result = mysqli_query( $link, $sql );
  		$row = mysqli_fetch_assoc( $result );
  		$curr_userid = get_current_user_id();
  		$exer_id = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['eid'] ) );
  		$answer_db = strtolower( $row['answer'] );
  		if ( $answer_db == $answer ) {
  			$sql = "UPDATE users_answer SET correct='yes' WHERE user_id='".$curr_userid."' AND user_last_exercise_id='".$exer_id."' AND user_last_qid='".$quest_id."';";
  			mysqli_query( $link, $sql );
  			return true;
  		} else {
  			$sql = "UPDATE users_answer SET correct='no' WHERE user_id='".$curr_userid."' AND user_last_exercise_id='".$exer_id."' AND user_last_qid='".$quest_id."';";
  			mysqli_query( $link, $sql );
  			return false;	
  		}
	}

	function store_last_answer( $exer_id, $qid, $last_answer ) {
		// TODO: Stored at users_answer
		global $link;
		$curr_userid = get_current_user_id();

		$query = mysqli_query( $link, "SELECT * FROM users_answer WHERE (user_id='".$curr_userid."' AND user_last_exercise_id='".$exer_id."' AND user_last_qid='".$qid."' )" );

		if ( mysqli_num_rows( $query ) > 0 ) {
			$sql = "UPDATE users_answer SET user_id='$curr_userid', user_last_exercise_id='$exer_id', user_last_qid='$qid', user_last_answer='$last_answer' WHERE user_id='".$curr_userid."' AND user_last_exercise_id='".$exer_id."' AND user_last_qid='".$qid."';";
			//echo "DATA ALREADY EXIST!";
		} else {	
    		if ( @!mysqli_query( $link,$query ) ) {
    			$sql = "INSERT INTO users_answer (user_id,user_last_exercise_id,user_last_qid,user_last_answer) VALUES  ('$curr_userid', '$exer_id', '$qid', '$last_answer');";
    			//echo "NEW DATA ADDED!";
    		}
		}
		mysqli_query( $link, $sql );
	}


	
?>