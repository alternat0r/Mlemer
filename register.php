<?php
	require_once "inc/lib.php";
	require_once "inc/config.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}

	$register_error = "";

	if ( isset( $_POST['submit'] ) ) {
		csrf_verify();

		$regUsername = trim( (string) ( $_POST['username'] ?? '' ) );
		$regRealname = trim( (string) ( $_POST['realname'] ?? '' ) );
		$regPassword = (string) ( $_POST['password'] ?? '' );

		if ( $regUsername === '' || $regRealname === '' || $regPassword === '' ) {
			$register_error = error_msg( "danger", "OPS!", "Username, real name and password are all required.", "1" );
		} else {
			$existing = db_query( "SELECT id FROM users WHERE user_loginname = ? LIMIT 1", "s", $regUsername );
			if ( $existing && mysqli_num_rows( $existing ) > 0 ) {
				$register_error = error_msg( "danger", "OPS!", "That username is already taken.", "1" );
			} else {
				$hash = password_hash( $regPassword, PASSWORD_DEFAULT );
				$new_id = db_execute(
					"INSERT INTO users (user_loginname, user_realname, user_password, user_activated, user_ip, user_hostname, user_uid, user_point) VALUES (?, ?, ?, 1, '', '', ?, 0)",
					"ssss", $regUsername, $regRealname, $hash, $regUsername
				);

				if ( $new_id ) {
					session_regenerate_id( true );
					$_SESSION['user_id'] = (int) $new_id;
					header( "Location: ?p=home" );
					exit;
				} else {
					$register_error = error_msg( "danger", "ERROR", "Registration failed. Please try again.", "1" );
				}
			}
		}
	}
?>
<p>
	<h2 class="page-header">
		Register
		<small>You need to register first in order to proceed.</small>
	</h2>

	<?php echo $register_error; ?>

	<form class="form-horizontal" action="?p=register" method="post">
	  <?php echo csrf_field(); ?>
	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
	    <div class="col-sm-10">
	      <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="User Name" required="true">
	    </div>
	  </div>
  	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Real Name</label>
	    <div class="col-sm-10">
	      <input type="text" name="realname" class="form-control" id="inputEmail3" placeholder="Real Name (Your name will be displayed)" required="true">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
	    <div class="col-sm-10">
	      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" required="true">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" name="submit" class="btn btn-success" title="Click to submit your registration.">Register</button>
	    </div>
	  </div>
	</form>
</p>
