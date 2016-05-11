<h2 class="page-header">Manager</h2>

<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="?p=exercise">Exercise</a></li>
  <li role="presentation"><a href="?p=quest">Questionaire</a></li>
</ul>
<br/>
<!-- Button trigger modal - Add New Exercise -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#BtnAddNewExercise">
	Add New Exercise
</button>

<h3 class="sub-header">List of Exercises</h3>
	          <div class="table-responsive">
	            <table class="table table-hover table-bordered">
	              <thead>
	                <tr>
	                  <th style="text-align: center">#</th>
	                  <th>Exercise Name</th>
	                  <th style="text-align: center">Total Question</th>
	                  <th style="text-align: center">Activated?</th>
	                  <th style="text-align: center"><div class="glyphicon glyphicon-cog"></div></th>
	                </tr>
	              </thead>
	              <tbody>
	              <?php
		              	$sql = "SELECT * FROM exercise";
		              	$user_count = "";
						$result = mysqli_query( $link, $sql );
						while( $row = @mysqli_fetch_assoc( $result ) ) {
							$user_count++;
							echo "<tr>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">" . $user_count . "</td>\n";
							echo "	<td style=\"vertical-align: middle;\">" . $row['exer_name'] . "</td>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">5</td>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">" . $row['activated'] . "</td>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\"><a href=\"#\" class=\"btn btn-default glyphicon glyphicon-pencil\"></a>&nbsp;<a href=\"#\" class=\"btn btn-danger glyphicon glyphicon-trash\"></a></td>\n";
							echo "</tr>\n";
						}
	              ?>
	              </tbody>
	            </table>
	            <h4>Total Exercise: <?php echo $user_count; ?></h4>
	          </div>


<!-- Modal -->
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
        	<input class="form-control" type="text" id="inExerciseName" placeHolder="Enter your exercise name" required="true" />
        </div>
        <div class="form-group">
			<label for="inExerciseDesc">Exercise Description:</label>
        	<input class="form-control" type="text" id="inExerciseDesc" placeHolder="Enter your exercise description" required="true"/>
        </div>
        <div class="form-group">
			<label for="inExerciseCategory">Category:</label>
        	<input class="form-control" type="text" id="inExerciseCategory" placeHolder="Choose your category" required="true"/>
        </div>
        <div class="checkbox">
  			<label><input type="checkbox" value="">Activated?</label>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add New Exercise</button>
      </div>
    </div>
  </div>
</div>