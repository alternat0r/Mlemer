<?php
	require_once "inc/config.php";
?>

			<h2 class="page-header">Dashboard</h2>
<h3 class="sub-header">Available Exercise</h3>
	<div class="row">

        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>
        </div>

        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>
        </div>
     </div>

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

