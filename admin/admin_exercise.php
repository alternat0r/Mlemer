<h2 class="page-header">Manager</h2>

<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="?p=exercise">Exercise</a></li>
  <li role="presentation"><a href="?p=quest">Questionaire</a></li>
</ul>
<br/>
<button type="button" class="btn btn-success">Add New Exercise</button>

<h3 class="sub-header">List of Exercises</h3>
	          <div class="table-responsive">
	            <table class="table table-hover">
	              <thead>
	                <tr>
	                  <th style="text-align: center">#</th>
	                  <th>Exercise Name</th>
	                  <th style="text-align: center">Total Question</th>
	                  <th style="text-align: center">Activated?</th>
	                  <th>Menu</th>
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
							echo "	<td align=\"center\">" . $user_count . "</td>\n";
							echo "	<td>" . $row['exer_name'] . "</td>\n";
							echo "	<td align=\"center\">5</td>\n";
							echo "	<td align=\"center\">" . $row['activated'] . "</td>\n";
							echo "	<td><a href=\"#\" class=\"glyphicon glyphicon-edit\"></a>&nbsp;<a href=\"#\" class=\"glyphicon glyphicon-remove\"></a></td>\n";
							echo "</tr>\n";
						}
	              ?>
	              </tbody>
	            </table>
	            <h4>Total Exercise: <?php echo $user_count; ?></h4>
	          </div>