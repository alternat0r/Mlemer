<?php
	if (isset( $REQUEST['user_name'] ) &&
	isset( $REQUEST['user_real'] ) &&
	isset( $REQUEST['user_ip'] ) &&
	isset( $REQUEST['user_hostname'] ) &&
	isset( $REQUEST['user_activate'] ) ) {
		$user_name = strip_tags( mysqli_real_escape_string( $link, $REQUEST['user_name'] );
		$user_real = strip_tags( mysqli_real_escape_string( $link, $REQUEST['user_real'] );
		$user_ip = strip_tags( mysqli_real_escape_string( $link, $REQUEST['user_ip'] );
		$user_hostname = strip_tags( mysqli_real_escape_string( $link, $REQUEST['user_hostname'] );
		$user_activate = strip_tags( mysqli_real_escape_string( $link, $REQUEST['user_activate'] );
	}
	
?>


<h2 class="page-header">User Management</h2>
<div class="row">
  <div class="col-xs-12 col-md-8">
  		<!-- Button trigger modal - Add New Exercise -->
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#BtnAddNewUser">
			Add New User
		</button>
  </div>
  <div class="col-xs-6 col-md-4">
		<div class="input-group">
  			<span class="input-group-addon" id="basic-addon1">Total Registered User:</span>
  			<input style="text-align: center" type="text" class="form-control" placeholder="0" aria-describedby="basic-addon1" value="<?php echo count_registered_user(); ?>" disabled>
		</div>
  </div>
</div>

<br/>
<br/>
<table class="table table-hover">
	<thead>
		<tr>
			<th>#</th>
			<th style="text-align: center">Icon</th>
			<th>Timestamp</th>
			<th>User Name</th>
			<th>IP/Hostname</th>
			<th style="text-align: center">Activated?</th>
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
							$userid = $row['id'];
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
								if ( $row['user_activated'] == "1" ) {
									$activated = "<span class=\"glyphicon glyphicon-ok\" style=\"color:green\"></span>";
								} else {
									$activated = "<span class=\"glyphicon glyphicon-ok\" style=\"color:#E6E6E6\"></span>";
								}
								echo "	<td style=\"text-align: center; vertical-align: middle;\">".$activated."</td>\n";
								echo "	<td style=\"text-align: center; vertical-align: middle;\"><a href=\"#\" class=\"btn btn-default glyphicon glyphicon-pencil\"></a>&nbsp;<a href=\"?deluid=".$userid."\" class=\"btn btn-danger glyphicon glyphicon-trash\"></a></td>\n";
								echo "</tr>\n";
							}
						}
	              ?>
	</tbody>
</table>

<!-- Modal Add New User -->
<form method="post" action="" >
<div class="modal fade" id="BtnAddNewUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New User</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="inExerciseName">User Login Name:</label>
        	<input class="form-control" type="text" name="user_name" id="inExerciseName" placeHolder="Enter user login name" required="true" />
        </div>
        <div class="form-group">
			<label for="inExerciseDesc">Real Name:</label>
        	<input class="form-control" type="text" name="user_real" id="inExerciseDesc" placeHolder="Enter user real name" required="true"/>
        </div>
        <div class="form-group">
			<label for="inExerciseCategory">IP Address:</label>
        	<input class="form-control" type="text" name="user_ip" id="inExerciseCategory" placeHolder="Enter IP address" required="true"/>
        </div>
        <div class="form-group">
			<label for="inExerciseCategory">Hostname:</label>
        	<input class="form-control" type="text" name="user_hostname" id="inExerciseCategory" placeHolder="Enter Hostname" required="true"/>
        </div>
        <div class="checkbox">
  			<label><input type="checkbox" name="user_activate" value="" checked>Activated?</label>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add New User</button>
      </div>
    </div>
  </div>
</div>
</form>
