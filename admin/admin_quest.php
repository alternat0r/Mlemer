<?php
	require_once "../inc/config.php";
    	require_once "../inc/lib.php";
	
	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}
	
	if ( isset( $_REQUEST['qQuestion'] ) && 
		isset( $_REQUEST['qAnswer'] ) &&
		isset( $_REQUEST['qPoint'] ) &&
		isset( $_REQUEST['qExer'] ) ) {

		$inqQuestion = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['qQuestion'] ) );
		$inqAnswer = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['qAnswer'] ) );
		$inqPoint = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['qPoint'] ) );
		$inqExer = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['qExer'] ) );

		admin_add_question( $inqQuestion, $inqAnswer, $inqPoint, $inqExer );
	}

	if ( isset($_REQUEST['exer_id']) ) {
		$exer_id = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['exer_id'] ) );
	} else {
		$exer_id = "1";
	}
?>
<h2 class="page-header">Manager</h2>

<ul class="nav nav-tabs">
  <li role="presentation"><a href="?p=exercise">Exercise</a></li>
  <li role="presentation" class="active"><a href="?p=quest">Questionaire</a></li>
  <li role="presentation"><a href="?p=category">Category</a></li>
</ul>

	<form action="?p=quest&exer_id=<?php echo $exer_id; ?>&select=" method="post">
	<label for="selectE"><h3 class="sub-header">Select Exercise:</h3></label>
	<div class="selectContainer">
        <select id="selectE" name="exer_id" class="form-control input-lg" onchange='if(this.value != 0) { this.form.submit(); }'>
        	<?php
              	$sql = "SELECT * FROM exercise";
              	$exer_count = "";
				$result = mysqli_query( $link, $sql );
				while( $row = @mysqli_fetch_assoc( $result ) ) {
					$exer_count++;
					if ( $row['id'] == $exer_id ) {
						echo "	<option value=\"".$row['id']."\" selected>" . $row['exer_name'] . "</option>\n";
					} else {
						echo "	<option value=\"".$row['id']."\">" . $row['exer_name'] . "</option>\n";
					}
				}
            ?>
        </select>
    </div>
    <input type="submit" hidden="hidden">
    </form>

    

		<h3 class="sub-header">List of Question</h3>
		<!-- Button trigger modal - Add New Exercise -->
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#BtnAddNewQuestion">
			Add New Question
		</button>
		<br/>
		<br/>
	          <div class="table-responsive">
	          	<div class="panel panel-default">
		            <table class="table table-hover table-bordered">
		              <thead>
		                <tr>
		                  <th>#</th>
		                  <th>Question</th>
		                  <th>Answer</th>
		                  <th style="text-align: center; vertical-align: middle;">Point</th>
		                  <th style="text-align: center; vertical-align: middle;"><div class="glyphicon glyphicon-cog"></div></th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php
			              	$sql = "SELECT * FROM questionaire WHERE exercise_id='$exer_id'";
			              	$user_count = "";
							$result = mysqli_query( $link, $sql );
							$q_count = mysqli_num_rows( $result );
							while( $row = @mysqli_fetch_assoc( $result ) ) {
								$user_count++;
								$quest_id = $row['id'];
								echo "<tr>\n";
								echo "	<td style=\"vertical-align: middle;\">" . $user_count . "</td>\n";
								echo "	<td style=\"vertical-align: middle;\">" . shorten( $row['question'], 50) . "</td>\n";
								echo "	<td style=\"vertical-align: middle;\">" . $row['answer'] . "</td>\n";
								echo "	<td style=\"text-align: center; vertical-align: middle;\">".$row['point']."</td>\n";
								echo "	<td style=\"text-align: center; vertical-align: middle;\"><a href=\"#\" class=\"btn btn-default glyphicon glyphicon-pencil\"></a>&nbsp;<a href=\"?questid=".$quest_id."\" class=\"btn btn-danger glyphicon glyphicon-trash\"></a></td>\n";
								echo "</tr>\n";
							}
		              ?>
		              </tbody>
		            </table>
		        </div>
		        <?php 
		        	if ( $q_count == 0 ) {
		        		echo error_msg( "warning", "OPS!", "No question available. Please add some.", "0" );
		        		$user_count = 0;
		        	}
		        ?>
	            <h4>Total Question: <?php echo $user_count; ?></h4>
	          </div>

<!-- Modal -->
<form action="" method="post">
<div class="modal fade" id="BtnAddNewQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Question</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="inExerciseName">Question:</label>
        	<textarea rows="5" class="form-control" type="text" name="qQuestion" id="inExerciseName" placeHolder="Enter your question" required="true" /></textarea>
        </div>
        <div class="form-group">
			<label for="inExerciseDesc">The Answer:</label>
        	<input class="form-control" type="text" id="inExerciseDesc" name="qAnswer" placeHolder="Enter the answer for the question" required="true"/>
        </div>
        <div class="form-group">
			<label for="inExerciseDesc">Worth Point:</label>
        	<input class="form-control" type="text" id="inExerciseDesc" name="qPoint" placeHolder="Enter point number worth for answering this question. Example: 10" required="true"/>
        </div>

		<label for="selectE">Select Exercise:</label>
		<div class="selectContainer">
	        <select id="selectE" class="form-control" name="qExer">
	        	<?php
	              	$sql = "SELECT * FROM exercise";
	              	$user_count = "";
					$result = mysqli_query( $link, $sql );
					while( $row = @mysqli_fetch_assoc( $result ) ) {
						$user_count++;
						if ( $user_count == 1 ) {
							echo "	<option value=\"".$row['id']."\" selected=\"selected\" name=\"qExer\">" . $row['exer_name'] . "</option>\n";
						} else {
							echo "	<option value=\"".$row['id']."\" name=\"qExer\">" . $row['exer_name'] . "</option>\n";
						}
					}
	            ?>
	        </select>
	    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="qSubmit" class="btn btn-primary">Add New Question</button>
      </div>
    </div>
  </div>
</div>
</form>
