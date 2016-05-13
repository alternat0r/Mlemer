<?php

	if ( isset($_REQUEST['answer']) ) {
		$answer = $_REQUEST['answer'];
		if ( $answer == "jambu" ) {
			echo "	<td style=\"vertical-align: middle;\"><div class=\"glyphicon glyphicon-ok-circle\"  style=\"color:#01DF3A\" ></div></td>";
		} else {
			echo "	<td style=\"vertical-align: middle;\"><div class=\"glyphicon glyphicon-remove-circle\"  style=\"color:#FF0040\" ></div></td>";
		}
	}

	function check_answer_on_db( $answer ) {
		global $link;
		$sql = "SELECT * FROM questionaire";
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