<?php
	require_once "../inc/config.php";
	require_once "../inc/lib.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}

	if ( isset( $_POST['inExerciseName'] ) &&
		isset( $_POST['inExerciseDesc'] ) &&
		isset( $_POST['inExerciseDescLong'] ) &&
		isset( $_POST['cat_id'] ) ) {

		csrf_verify();

		$inCatName = (string) $_POST['inExerciseName'];
		$inCatDesc = (string) $_POST['inExerciseDesc'];
		$inCatDescLong = (string) $_POST['inExerciseDescLong'];
		$inCatId = (int) $_POST['cat_id'];
		$inCatActive = isset( $_POST['activated'] ) ? 1 : 0;

		admin_add_exercise( $inCatName, $inCatDesc, $inCatDescLong, $inCatId, $inCatActive );
	}
?>



<h2 class="page-header">Manager</h2>

<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="?p=exercise">Exercise</a></li>
  <li role="presentation"><a href="?p=quest">Questionaire</a></li>
  <li role="presentation"><a href="?p=category">Category</a></li>
</ul>
<br/>
<!-- Button trigger modal - Add New Exercise -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#BtnAddNewExercise">
	Add New Exercise
</button>

<h3 class="sub-header">List of Exercises</h3>
	          <div class="table-responsive">
	          <div class="panel panel-default">
	            <table class="table table-hover table-bordered">
	              <thead>
	                <tr>
	                  <th style="text-align: center; vertical-align: middle">#</th>
	                  <th style="vertical-align: middle">Exercise Name</th>
	                  <th style="vertical-align: middle">Description</th>
	                  <th style="text-align: center; vertical-align: middle">Total Question</th>
	                  <th style="text-align: center; vertical-align: middle">Activated?</th>
	                  <th style="text-align: center; vertical-align: middle"><div class="glyphicon glyphicon-cog"></div></th>
	                </tr>
	              </thead>
	              <tbody>
	              <?php
		              	$sql = "SELECT * FROM exercise";
		              	$user_count = "";
						$result = mysqli_query( $link, $sql );
						while( $row = @mysqli_fetch_assoc( $result ) ) {
							$user_count++;
							$exer_id = (int) $row['id'];
							echo "<tr>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">" . $user_count . "</td>\n";
							echo "	<td style=\"vertical-align: middle;\">" . e( $row['exer_name'] ) . "</td>\n";
							echo "	<td style=\"vertical-align: middle;\" title=\"".e( $row['exer_description'] )."\">" . e( shorten( $row['exer_description'], 35) ) . "</td>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">".(int) count_available_question_by_exercise( $exer_id )."</td>\n";

							if ( $row['activated'] == "1" ) {
								$activated = "<span class=\"glyphicon glyphicon-ok\" title=\"Activated\" style=\"color:green\"></span>";
							} else {
								$activated = "<span class=\"glyphicon glyphicon-ok\" title=\"Deactivated\" style=\"color:#E6E6E6\"></span>";
							}
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">" . $activated . "</td>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">";
							echo "<form method=\"post\" action=\"?p=exercise\" style=\"display:inline\" onsubmit=\"return confirm('Delete this exercise permanently?');\">";
							echo csrf_field();
							echo "<input type=\"hidden\" name=\"exerid\" value=\"".$exer_id."\">";
							echo "<button type=\"submit\" class=\"btn btn-danger glyphicon glyphicon-trash\"></button>";
							echo "</form>";
							echo "</td>\n";
							echo "</tr>\n";
						}
	              ?>
	              </tbody>
	            </table>
	            </div>
	            <h4>Total Exercise: <?php echo (int) $user_count; ?></h4>
	          </div>


<!-- Modal -->
<form action="?p=exercise" method="post">
<?php echo csrf_field(); ?>
<div class="modal fade" id="BtnAddNewExercise" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Exercise</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="inExerciseName">Exercise Name:</label>
        	<input class="form-control" type="text" name="inExerciseName" id="inExerciseName" placeHolder="Enter your exercise name" required="true" />
        </div>
        <div class="form-group">
			<label for="inExerciseDesc">Exercise Description:</label>
        	<input class="form-control" type="text" id="inExerciseDesc" name="inExerciseDesc" placeHolder="Enter your exercise description" required="true"/>
        </div>
        <div class="form-group">
			<label for="inExerciseDesc">Exercise Description (Long):</label>
        	<textarea rows="7" class="form-control" type="text" name="inExerciseDescLong" id="inExerciseDescLong" placeHolder="Enter your exercise long description" required="true"></textarea>
        </div>
		<label for="selectE">Select Category:</label>
		<div class="selectContainer">
	        <select id="selectE" name="cat_id" class="form-control" >
	        	<?php
	              	$sql = "SELECT * FROM category";
					$result = mysqli_query( $link, $sql );
					while( $row = @mysqli_fetch_assoc( $result ) ) {
							echo "	<option value=\"".(int) $row['id']."\">" . e( $row['category_name'] ) . "</option>\n";
					}
	            ?>
	        </select>
	    </div>
        <div class="checkbox">
  			<label><input name="activated" type="checkbox" checked>Activated?</label>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="btnAddNewExercise" class="btn btn-primary">Add New Exercise</button>
      </div>
    </div>
  </div>
</div>
</form>
