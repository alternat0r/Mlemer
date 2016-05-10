<?php
	require_once "inc/config.php";
?>
			<h2 class="page-header">Dashboard</h2>
			<h3 class="sub-header">Available Exercise</h3>

			<style>
				.hoverDiv:hover { background: #E0F2F7; }
				.NoUnderLine { text-decoration: none !important; }
			</style>
			
				<?php
	              	$sql = "SELECT * FROM exercise";
	              	$user_count = "";
					$result = mysqli_query( $link, $sql );
					while( $row = @mysqli_fetch_assoc( $result ) ) {
						$user_count++;
						echo "<a class=\"NoUnderLine\" href=\"#\">";
						echo "<div class=\"bs-callout bs-callout-info hoverDiv\" id=\"callout-input-needs-type\">\n";
						echo "	<h4>" . $row['exer_name'] . "</h4>";
						echo "	<p>" . $row['exer_description'] . "</p>\n";
						echo "</div>\n";
						echo "</a>";

					}
				?>
 			

			<h3 class="sub-header">Top Scorer</h3>
	          <div class="table-responsive">
	            <table class="table table-hover">
	              <thead>
	                <tr>
	                  <th>#</th>
	                  <th>Player Name</th>
	                  <th>Point</th>
	                </tr>
	              </thead>
	              <tbody>
	              <?php
		              	$sql = "SELECT * FROM users";
		              	$user_count = "";
						$result = mysqli_query( $link, $sql );
						while( $row = mysqli_fetch_assoc( $result ) ) {
							$user_count++;
							if ( $row['user_realname'] != "Administrator" and $row['user_realname'] != "" ) {
								echo "<tr>\n";
								echo "	<td>" . $user_count . "</td>\n";
								echo "	<td>" . $row['user_realname'] . "</td>\n";
								echo "	<td>10</td>\n";
								echo "</tr>\n";
							}
						}
	              ?>
	              </tbody>
	            </table>
	          </div>

