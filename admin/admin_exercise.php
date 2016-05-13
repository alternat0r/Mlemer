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
							echo "<tr>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">" . $user_count . "</td>\n";
							echo "	<td style=\"vertical-align: middle;\">" . $row['exer_name'] . "</td>\n";
							echo "	<td style=\"vertical-align: middle;\" title=\"".$row['exer_description']."\">" . shorten( $row['exer_description'], 35) . "</td>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">5</td>\n";
							if ( $row['activated'] == "1" ) {
								$activated = "<span class=\"glyphicon glyphicon-ok\" style=\"color:green\"></span>";
							} else {
								$activated = "<span class=\"glyphicon glyphicon-ok\" style=\"color:#E6E6E6\"></span>";
							}
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">" . $activated . "</td>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\"><a href=\"#\" class=\"btn btn-default glyphicon glyphicon-pencil\"></a>&nbsp;<a href=\"#\" class=\"btn btn-danger glyphicon glyphicon-trash\"></a></td>\n";
							echo "</tr>\n";
						}
	              ?>
	              </tbody>
	            </table>
	            </div>
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
			<label for="inExerciseDesc">Exercise Description (Long):</label>
        	<textarea rows="7" class="form-control" type="text" id="inExerciseDesc" placeHolder="Enter your exercise long description" required="true"></textarea>
        </div>
		<label for="selectE">Select Category:</label>
		<div class="selectContainer">
	        <select id="selectE" class="form-control" onchange='if(this.value != 0) { this.form.submit(); }'>
	        	<?php
	              	$sql = "SELECT * FROM category";
					$result = mysqli_query( $link, $sql );
					while( $row = @mysqli_fetch_assoc( $result ) ) {
							echo "	<option value=\"".$row['id']."\" selected=\"selected\">" . $row['category_name'] . "</option>\n";
					}
	            ?>
	        </select>
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