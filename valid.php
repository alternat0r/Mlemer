<?php

	$answer = $_REQUEST['answer'];
	if ( $answer == "jambu" ) {
		echo "	<td style=\"vertical-align: middle;\"><div class=\"glyphicon glyphicon-ok-circle\"  style=\"color:#01DF3A\" ></div></td>";
	} else {
		echo "	<td style=\"vertical-align: middle;\"><div class=\"glyphicon glyphicon-remove-circle\"  style=\"color:#FF0040\" ></div></td>";
	}

	//echo "	<td style=\"vertical-align: middle;\"><div class=\"glyphicon glyphicon-question-sign\"  style=\"color:#E6E6E6\" id=\"demo\"></div></td>";
	
?>