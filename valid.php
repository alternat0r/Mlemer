<?php
	require_once "inc/config.php";
	require_once "inc/lib.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}

	require_login();
	csrf_verify();

	if ( isset( $_REQUEST['answer'] ) && isset( $_REQUEST['qid'] ) && isset( $_REQUEST['eid'] ) ) {
		$answer = (string) $_REQUEST['answer'];
		$exer_id = (int) $_REQUEST['eid'];
		$quest_id = (int) $_REQUEST['qid'];

		if ( check_answer_on_db( $quest_id, $answer, $exer_id ) == true ) {
			echo "	<td style=\"vertical-align: middle;\"><div class=\"glyphicon glyphicon-ok-circle\" title=\"Your answer is correct.\" style=\"color:#01DF3A\" ></div></td>";
		} else {
			echo "	<td style=\"vertical-align: middle;\"><div class=\"glyphicon glyphicon-remove-circle\" title=\"Your answer is wrong. Try again.\" style=\"color:#FF0040\" ></div></td>";
		}
		store_last_answer( $exer_id, $quest_id, $answer );
		save_user_point( get_current_user_id() );
	}

	function check_answer_on_db( $quest_id, $answer, $exer_id ) {
		$result = db_query( "SELECT * FROM questionaire WHERE id = ?", "i", $quest_id );
  		$row = $result ? mysqli_fetch_assoc( $result ) : false;
  		$curr_userid = get_current_user_id();
  		$answer_db = $row['answer'] ?? '';

  		if ( strtolower( $answer_db ) == strtolower( $answer ) ) {
  			db_execute(
  				"UPDATE users_answer SET correct = 'yes' WHERE user_id = ? AND user_last_exercise_id = ? AND user_last_qid = ?",
  				"iii", $curr_userid, $exer_id, $quest_id
  			);
  			return true;
  		} else {
  			db_execute(
  				"UPDATE users_answer SET correct = 'no' WHERE user_id = ? AND user_last_exercise_id = ? AND user_last_qid = ?",
  				"iii", $curr_userid, $exer_id, $quest_id
  			);
  			return false;
  		}
	}

	function store_last_answer( $exer_id, $qid, $last_answer ) {
		$curr_userid = get_current_user_id();

		$existing = db_query(
			"SELECT id FROM users_answer WHERE user_id = ? AND user_last_exercise_id = ? AND user_last_qid = ?",
			"iii", $curr_userid, $exer_id, $qid
		);

		if ( $existing && mysqli_num_rows( $existing ) > 0 ) {
			$is_correct = check_answer_on_db( $qid, $last_answer, $exer_id ) ? "yes" : "no";
			db_execute(
				"UPDATE users_answer SET user_last_answer = ?, correct = ? WHERE user_id = ? AND user_last_exercise_id = ? AND user_last_qid = ?",
				"ssiii", $last_answer, $is_correct, $curr_userid, $exer_id, $qid
			);
		} else {
			$is_correct = check_answer_on_db( $qid, $last_answer, $exer_id ) ? "yes" : "no";
			db_execute(
				"INSERT INTO users_answer (user_id, user_last_exercise_id, user_last_qid, user_last_answer, correct) VALUES (?, ?, ?, ?, ?)",
				"iiiss", $curr_userid, $exer_id, $qid, $last_answer, $is_correct
			);
		}
	}
?>
