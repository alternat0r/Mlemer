<?php
	require_once "inc/config.php";
	require_once "inc/lib.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    error_reporting( 0 );
	}

	$login_error = "";

	if ( isset( $_POST['submit'] ) ) {
		csrf_verify();

		if ( empty( $_POST['username'] ) || empty( $_POST['password'] ) ) {
			$login_error = error_msg( "danger", "OPS!", "Username or Password is invalid", "1" );
		} else {
			$username = (string) $_POST['username'];
			$password = (string) $_POST['password'];

			$result = db_query( "SELECT * FROM users WHERE user_loginname = ? LIMIT 1", "s", $username );
			$row = $result ? mysqli_fetch_assoc( $result ) : false;

			if ( $row && !empty( $row['user_password'] ) && password_verify( $password, $row['user_password'] ) ) {
				session_regenerate_id( true );
				$_SESSION['user_id'] = (int) $row['id'];
				header( "Location: ?p=home" );
				exit;
			} else {
				$login_error = error_msg( "danger", "OPS!", "Invalid username or password.", "1" );
			}
		}
	}
?>

<h2 class="page-header">Login</h2>

<?php echo $login_error; ?>

<form class="form-horizontal" action="?p=login" method="post">
  <?php echo csrf_field(); ?>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
    <div class="col-sm-10">
      <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="Username">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>
