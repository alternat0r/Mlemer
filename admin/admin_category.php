<h2 class="page-header">Manager</h2>

<ul class="nav nav-tabs">
  <li role="presentation"><a href="?p=exercise">Exercise</a></li>
  <li role="presentation"><a href="?p=quest">Questionaire</a></li>
  <li role="presentation" class="active"><a href="?p=category">Category</a></li>
</ul>
<br/>
<!-- Button trigger modal - Add New Category -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#BtnAddNewCategory">
	Add New Category
</button>

<h3 class="sub-header">List of Category</h3>
	          <div class="table-responsive">
	          <div class="panel panel-default">
	            <table class="table table-hover table-bordered">
	              <thead>
	                <tr>
	                  <th style="text-align: center; vertical-align: middle">#</th>
	                  <th style="vertical-align: middle">Category Name</th>
	                  <th style="vertical-align: middle">Category Description</th>
	                  <th style="text-align: center; vertical-align: middle"><div class="glyphicon glyphicon-cog"></div></th>
	                </tr>
	              </thead>
	              <tbody>
	              <?php
		              	$sql = "SELECT * FROM category";
		              	$user_count = "";
						$result = mysqli_query( $link, $sql );
						while( $row = @mysqli_fetch_assoc( $result ) ) {
							$user_count++;
							echo "<tr>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">" . $user_count . "</td>\n";
							echo "	<td style=\"vertical-align: middle;\">" . $row['category_name'] . "</td>\n";
							echo "	<td style=\"vertical-align: middle;\" title=\"".$row['category_description']."\">" . shorten( $row['category_description'], 35) . "</td>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\"><a href=\"#\" class=\"btn btn-default glyphicon glyphicon-pencil\"></a>&nbsp;<a href=\"#\" class=\"btn btn-danger glyphicon glyphicon-trash\"></a></td>\n";
							echo "</tr>\n";
						}
	              ?>
	              </tbody>
	            </table>
	            </div>
	            <h4>Total Category: <?php echo $user_count; ?></h4>
	          </div>


<!-- Modal -->
<div class="modal fade" id="BtnAddNewCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Category</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="inExerciseName">Category Name:</label>
        	<input class="form-control" type="text" id="inExerciseName" placeHolder="Enter category name" required="true" />
        </div>
        <div class="form-group">
			<label for="inExerciseDesc">Category Description:</label>
        	<input class="form-control" type="text" id="inExerciseDesc" placeHolder="Enter category description" required="true"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Add New Category</button>
      </div>
    </div>
  </div>
</div>