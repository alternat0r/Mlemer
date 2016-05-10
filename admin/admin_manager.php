<h2 class="page-header">Manager</h2>

<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#">Exercise</a></li>
  <li role="presentation"><a href="#">Messages</a></li>
</ul>
<br/>
<button type="button" class="btn btn-success">Add New Exercise</button>

<h3 class="sub-header">List of Exercises</h3>
	          <div class="table-responsive">
	            <table class="table table-hover">
	              <thead>
	                <tr>
	                  <th>#</th>
	                  <th>Exercise Name</th>
	                  <th>Total Question</th>
	                  <th>Menu</th>
	                </tr>
	              </thead>
	              <tbody>
	              <?php
		              	$sql = "SELECT * FROM exercise";
		              	$user_count = "";
						$result = mysqli_query( $link, $sql );
						while( $row = mysqli_fetch_assoc( $result ) ) {
							$user_count++;
								echo "<tr>\n";
								echo "	<td>" . $user_count . "</td>\n";
								echo "	<td>" . $row['exer_name'] . "</td>\n";
								echo "	<td></td>\n";
								echo "	<td><a href=\"#\" class=\"glyphicon glyphicon-edit\"></a>&nbsp;<a href=\"#\" class=\"glyphicon glyphicon-remove\"></a></td>\n";
								echo "</tr>\n";
						}
	              ?>
	              </tbody>
	            </table>
	            <h4>Total Exercise: <?php echo $user_count; ?></h4>
	          </div>