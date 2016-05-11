<h2 class="page-header">User Management</h2>

<table class="table table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th style="text-align: center">Icon</th>
			<th>Timestamp</th>
			<th>User Name</th>
			<th>IP/Hostname</th>
			<th style="text-align: center"><div class="glyphicon glyphicon-cog"></div></th>
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
								echo "	<td style=\"vertical-align: middle;\">" . $user_count . "</td>\n";
								echo "	<td style=\"text-align: center; vertical-align: middle;\"><div style=\"align: center\" title=\"".$row['user_uid']."\"><i class=\"glyphicon glyphicon-user\"></i></div></td>\n";
								echo "	<td style=\"vertical-align: middle;\">" . $row['timestamp'] . "</td>\n";
								echo "	<td style=\"vertical-align: middle;\">";
								echo $row['user_loginname']."<br/>";
								echo "		<i>".$row['user_realname']."</i>";
								echo "	</td>\n";
								echo "	<td style=\"vertical-align: middle;\">";
								echo $row['user_ip']."<br/>";
								echo "		<i>".$row['user_hostname']."</i>";
								echo "	</td>\n";
								echo "	<td style=\"text-align: center; vertical-align: middle;\"><a href=\"#\" class=\"btn btn-default glyphicon glyphicon-pencil\"></a>&nbsp;<a href=\"#\" class=\"btn btn-danger glyphicon glyphicon-trash\"></a></td>\n";
								echo "</tr>\n";
							}
						}
	              ?>
	</tbody>
</table>