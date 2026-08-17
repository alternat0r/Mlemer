<?php
	require_once "inc/lib.php";
	require_once "inc/config.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
		error_reporting( 0 );
	}

	require_login();

	$exer_id = (int) ( $_REQUEST['e'] ?? 0 );

	$result = db_query( "SELECT * FROM exercise WHERE id = ?", "i", $exer_id );
	$row = $result ? mysqli_fetch_assoc( $result ) : false;

	$exer_name = e( $row['exer_name'] ?? '' );
	$exer_description = e( $row['exer_description'] ?? '' );
	if ( $exer_description === '' ) {
		$exer_description = "Not available.";
	}
	$exer_long = e( $row['exer_long'] ?? '' );
	if ( $exer_long === '' ) {
		$exer_long = "Not available.";
	}
?>



<h2 class="page-header"><?php echo $exer_name; ?></h2>

<div class="panel panel-default" style="border-color: #186F8A">
  <div class="panel-heading" style="border-color: #186F8A; color: #ffffff; background-color: #1b809e"><?php echo $exer_description; ?></div>
  <div class="panel-body">
    <?php echo $exer_long; ?>
  </div>
</div>

<div class="table-responsive">
	<div class="panel panel-default">
		<table class="table table-hover table-bordered">
			<thead>
	            <tr>
	              <th style="text-align: center; vertical-align: middle">#</th>
	              <th>Question</th>
	              <th style="text-align: center; vertical-align: middle"><span class="glyphicon glyphicon-question-sign" title="Determine whether your answer is correct or not"></span></th>
	              <th>Answer</th>
	            </tr>
            </thead>
			<tbody>
              <?php
	              	$result = db_query( "SELECT * FROM questionaire WHERE exercise_id = ?", "i", $exer_id );
	              	$user_count = 0;

					$js_valid = "";
					if ( $result ) {
						while( $row = @mysqli_fetch_assoc( $result ) ) {
							$user_count++;
							$quest_id = (int) $row['id'];

							$last_answer = e( get_last_answer( $exer_id, $quest_id ) );

							echo "<tr>\n";
							echo "	<td style=\"vertical-align: middle;\">" . $user_count . "</td>\n";
							echo "	<td width=\"70%\" style=\"vertical-align: middle;\">" . e( $row['question'] ) . "</td>\n";
							if ( check_last_answer_is_correct_or_not( $exer_id, $quest_id ) == "yes" ) {
								echo "	<td style=\"vertical-align: middle;\"><div style=\"color:#E6E6E6\" id=\"a".$user_count."\"><div class=\"glyphicon glyphicon-ok-circle\" title=\"Your answer is correct.\" style=\"color:#01DF3A\" ></div></div></td>\n";
							} else {
								echo "	<td style=\"vertical-align: middle;\"><div style=\"color:#E6E6E6\" id=\"a".$user_count."\"><div class=\"glyphicon glyphicon-question-sign\"  style=\"color:#E6E6E6\" ></div></div></td>\n";
							}
							echo "	<td style=\"text-align: center; vertical-align: middle; \">\n";
							echo "		<div class=\"input-group\">\n";
							echo "			<input class=\"form-control\" type=\"text\" id=\"userInput".$user_count."\" placeholder=\"Answer here\" value=\"".$last_answer."\" />\n";
							echo "			<span class=\"input-group-btn\">\n";
							echo "				<button".$user_count." type=\"button\" class=\"checkAnswer btn btn-default \" title=\"Click to check your answer\">\n";
							echo "					<span class=\"glyphicon glyphicon-circle-arrow-right\"></span>&nbsp;\n";
							echo "				</button".$user_count.">\n";
							echo "			</span>\n";
							echo "		</div>\n";
							echo "	</td>\n";
							echo "</tr>\n";

							$js_valid .= "butt( \"".$exer_id."\", \"".$quest_id."\", \"button".$user_count."\", \"userInput".$user_count."\", \"a".$user_count."\");\n";
						}
					}

              ?>
			</tbody>
		</table>
	</div>
			<?php
				if ( $user_count === 0 ) {
					echo error_msg( "warning", "OPS!", "There is no question available. Please ask administrator.", "0");
				}
			?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js" integrity="sha384-ECTndYny330R2jlSXBiZkdXzAVi0Z/iDXJTwV6cp39HECmalqg6+b2sFZFf/Y2m6" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
	<?php
		echo $js_valid;
	?>
});
function butt( exer_id, quest_id, button, userInput, outputId ) {
    $(button).click(function() {
        var userInput1 = document.getElementById(userInput).value; // unserInput = to take user input
        $.post("valid.php", { answer: userInput1, qid: quest_id, eid: exer_id, csrf_token: "<?php echo csrf_token(); ?>" },
        function( data, status ) {
           	document.getElementById(outputId).innerHTML = data; //a2 = place to display
        });

    });
}

</script>
