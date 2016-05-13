<?php
	require_once "inc/config.php";
	require_once "inc/lib.php";

	if ( isset($_REQUEST['answer']) ) {
		$answer = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['answer'] ) );
		$quest_id = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['qid'] ) );

		if ( check_answer_on_db( $quest_id, $answer ) == true ) {
			echo "	<td style=\"vertical-align: middle;\"><div class=\"glyphicon glyphicon-ok-circle\"  style=\"color:#01DF3A\" ></div></td>";
		} else {
			echo "	<td style=\"vertical-align: middle;\"><div class=\"glyphicon glyphicon-remove-circle\"  style=\"color:#FF0040\" ></div></td>";
		}
	}

	function check_answer_on_db( $id, $answer ) {
		global $link;
		$sql = "SELECT * FROM questionaire WHERE id='$id';";
  		$result = mysqli_query( $link, $sql );
  		$row = mysqli_fetch_assoc( $result );
  		$answer_db = $row['answer'];
  		if ( $answer_db == $answer ) {
  			return true;
  		} else {
  			return false;	
  		}
	}
	
?>