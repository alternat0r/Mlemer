<?php
	require_once "../inc/config.php";
	require_once "../inc/lib.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}

	if ( isset( $_POST['user_name'] ) && isset( $_POST['user_real'] ) && isset( $_POST['user_password'] ) ) {
		csrf_verify();

		$user_name = trim( (string) $_POST['user_name'] );
		$user_real = trim( (string) $_POST['user_real'] );
		$user_password = (string) $_POST['user_password'];
		$user_activate = isset( $_POST['user_activate'] ) ? 1 : 0;

		if ( $user_name === '' || $user_real === '' || $user_password === '' ) {
			echo error_msg( "danger", "OPS!", "Login name, real name and password are all required.", "1" );
		} else {
			admin_add_user( $user_name, $user_real, $user_password, $user_activate );
		}
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
  			<input style="text-align: center" type="text" class="form-control" placeholder="0" aria-describedby="basic-addon1" value="<?php echo (int) count_registered_user(); ?>" disabled>
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
			<th style="text-align: center">Activated?</th>
			<th style="text-align: center">Point</th>
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
							$userid = (int) $row['id'];
							if ( $row['user_realname'] != "Administrator" and $row['user_realname'] != "" ) {
								echo "<tr>\n";
								echo "	<td style=\"vertical-align: middle;\">" . $user_count . "</td>\n";
								echo "	<td style=\"text-align: center; vertical-align: middle;\"><i class=\"glyphicon glyphicon-user\"></i></td>\n";
								echo "	<td style=\"vertical-align: middle;\">" . e( $row['timestamp'] ) . "</td>\n";
								echo "	<td style=\"vertical-align: middle;\">";
								echo e( $row['user_loginname'] )."<br/>";
								echo "		<i>".e( $row['user_realname'] )."</i>";
								echo "	</td>\n";
								if ( $row['user_activated'] == "1" ) {
									$activated = "<span class=\"glyphicon glyphicon-ok\" style=\"color:green\"></span>";
								} else {
									$activated = "<span class=\"glyphicon glyphicon-ok\" style=\"color:#E6E6E6\"></span>";
								}
								echo "	<td style=\"text-align: center; vertical-align: middle;\">".$activated."</td>\n";
								echo "	<td style=\"text-align: center; vertical-align: middle;\">".(int) get_perplayer_total_point( $userid )."</td>\n";
								echo "	<td style=\"text-align: center; vertical-align: middle;\">";
								echo "<form method=\"post\" action=\"?p=users\" style=\"display:inline\" onsubmit=\"return confirm('Delete this user permanently?');\">";
								echo csrf_field();
								echo "<input type=\"hidden\" name=\"deluid\" value=\"".$userid."\">";
								echo "<button type=\"submit\" class=\"btn btn-danger glyphicon glyphicon-trash\"></button>";
								echo "</form>";
								echo "</td>\n";
								echo "</tr>\n";
							}
						}
	              ?>
	</tbody>
</table>

<!-- Modal Add New User -->
<form method="post" action="?p=users" >
<?php echo csrf_field(); ?>
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
			<label for="inExercisePwd">Password:</label>
        	<input class="form-control" type="password" name="user_password" id="inExercisePwd" placeHolder="Enter a password for this user" required="true"/>
        </div>
        <div class="checkbox">
  			<label><input type="checkbox" name="user_activate" value="1" checked>Activated?</label>
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
