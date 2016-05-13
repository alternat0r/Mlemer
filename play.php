<?php
	$exer_id = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['e'] ) );

	$sql = "SELECT * FROM exercise WHERE id='$exer_id';";
	$result = mysqli_query( $link, $sql );
	$row = mysqli_fetch_assoc( $result );
	$exer_name = $row['exer_name'];
?>

<h2 class="page-header"><?php echo $exer_name; ?></h2>

<h3 class="sub-header">Question</h3>

<div class="table-responsive">
	<div class="panel panel-default">
		<table class="table table-hover table-bordered">
			<thead>
	            <tr>
	              <th style="text-align: center; vertical-align: middle">#</th>
	              <th>Question</th>
	              <th style="text-align: center; vertical-align: middle">?</th>
	              <th>Answer</th>
	            </tr>
            </thead>
			<tbody>				
              <?php
	              	$sql = "SELECT * FROM questionaire WHERE exercise_id='$exer_id'";
	              	$user_count = "";
					$result = mysqli_query( $link, $sql );
					while( $row = @mysqli_fetch_assoc( $result ) ) {
						$user_count++;
						echo "<tr>\n";
						echo "	<td style=\"vertical-align: middle;\">" . $user_count . "</td>\n";
						echo "	<td width=\"70%\" style=\"vertical-align: middle;\">" . $row['question'] . "</td>\n";

						echo "	<td style=\"vertical-align: middle;\"><div style=\"color:#E6E6E6\" id=\"a".$user_count."\"><div class=\"glyphicon glyphicon-question-sign\"  style=\"color:#E6E6E6\" ></div></div></td>\n";

						echo "	<td style=\"text-align: center; vertical-align: middle; \">\n";
						echo "		<div class=\"input-group\">\n";
						echo "			<input class=\"form-control\" type=\"text\" id=\"userInput".$user_count."\" placeholder=\"Answer here\" />\n";
						echo "			<span class=\"input-group-btn\">\n";
						echo "				<button".$user_count." type=\"button\" class=\"checkAnswer btn btn-default \" title=\"Click to check your answer\">\n";
						echo "					<span class=\"glyphicon glyphicon-circle-arrow-right\"></span>&nbsp;\n";
						echo "				</button".$user_count.">\n";
						echo "			</span>\n";
						echo "		</div>\n";
						echo "	</td>\n";
						echo "</tr>\n";
					}
              ?>
			</tbody>
		</table>
	</div>
</div>

<script>
$(document).ready(function() {    
	<?php
		for ($i=1; $i<$user_count+1; $i++) {
			echo "	butt(\"button".$i."\", \"userInput".$i."\", \"a".$i."\");\n";
		}
	?>
});
function butt( button, userInput, outputId ) {
    $(button).click(function() {
        var userInput1 = document.getElementById(userInput).value; // unserInput = to take user input
        $.post("valid.php", { answer: userInput1 },
        function( data, status ) {
           	document.getElementById(outputId).innerHTML = data; //a2 = place to display       
        });

    });
}

</script>