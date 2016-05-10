<h2 class="page-header">User Management</h2>

<table class="table table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th>Timestamp</th>
			<th>User Name</th>
			<th>Full Name</th>
			<th>IP Address</th>
			<th>Hostname</th>
			<th>UID</th>
			<th>Menu</th>
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
								echo "	<td>" . $row['timestamp'] . "</td>\n";
								echo "	<td>" . $row['user_loginname'] . "</td>\n";
								echo "	<td>" . $row['user_realname'] . "</td>\n";
								echo "	<td>" . $row['user_ip'] . "</td>\n";
								echo "	<td>" . $row['user_hostname'] . "</td>\n";
								echo "	<td>" . $row['user_uid'] . "</td>\n";
								echo "	<td><a href=\"#\" class=\"glyphicon glyphicon-edit\"></a>&nbsp;<a href=\"#\" class=\"glyphicon glyphicon-remove\"></a></td>\n";
								echo "</tr>\n";
							}
						}
	              ?>
	</tbody>
</table>