<?php
	require_once "inc/lib.php";
	require_once "inc/config.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}

	require_login();

	$account_msg = "";

	if ( isset( $_POST['submit'] ) ) {
		csrf_verify();

		$regUsername = trim( (string) ( $_POST['username'] ?? '' ) );
		$regRealname = trim( (string) ( $_POST['realname'] ?? '' ) );
		$regPassword = (string) ( $_POST['password'] ?? '' );

		if ( $regUsername === '' || $regRealname === '' ) {
			$account_msg = error_msg( "danger", "OPS!", "Username and real name are required.", "1" );
		} else {
			$existing = db_query(
				"SELECT id FROM users WHERE user_loginname = ? AND id != ? LIMIT 1",
				"si", $regUsername, current_user_id()
			);
			if ( $existing && mysqli_num_rows( $existing ) > 0 ) {
				$account_msg = error_msg( "danger", "OPS!", "That username is already taken.", "1" );
			} else {
				if ( $regPassword !== '' ) {
					$hash = password_hash( $regPassword, PASSWORD_DEFAULT );
					db_execute(
						"UPDATE users SET user_loginname = ?, user_realname = ?, user_password = ? WHERE id = ?",
						"sssi", $regUsername, $regRealname, $hash, current_user_id()
					);
				} else {
					db_execute(
						"UPDATE users SET user_loginname = ?, user_realname = ? WHERE id = ?",
						"ssi", $regUsername, $regRealname, current_user_id()
					);
				}
				$account_msg = error_msg( "success", "SUCCESS", "Your account has been updated.", "1" );
			}
		}
	}
?>
	<h2 class="page-header">
		Account
		<small>Here you can change password, username or remove account.</small>
	</h2>

	<?php echo $account_msg; ?>

  <div class="row">
    <div class="col-md-6">
      <form action="?p=account" method="post">
        <?php echo csrf_field(); ?>
        <div class="form-group">
            <label for="pg_productname">Username</label>
            <input class="form-control" name="username" id="pg_productname" placeholder="Your user name for login purpose" value="<?php echo e( get_current_username() ); ?>">
          </div>

        <div class="form-group">
            <label for="pg_title">Real Name</label>
            <input class="form-control" name="realname" id="pg_title" placeholder="Your Real Name (Your name will be displayed)" value="<?php echo e( get_current_user_realname() ); ?>" required="true">
          </div>
          <div class="form-group">
            <label for="pg_company">Password</label>
            <input class="form-control" name="password" id="pg_company" type="password" placeholder="Enter a new password to change. Otherwise, leave it blank.">
          </div>


          <div class="row">
            <div class="col-md-6">
              <input class="styled" type="checkbox" id="ShowPwd" onclick="if(pg_company.type=='text')pg_company.type='password'; else pg_company.type='text';" />
              <label for="ShowPwd">Show password?</label>
            </div>
            <div class="col-md-6 text-right">
              <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </div>
      </form>
    </div>
    <div class="col-md-6">
        <div class="bs-callout bs-callout-danger" id="callout-input-needs-type">
          <h4>Remove Account</h4>
          <p>Here you can remove your current account permenantly. You can register again after removal.</p>
          <!-- Button trigger modal - Remove Account -->
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#BtnRemoveAccount">
              Remove Account
          </button>
        </div>
    </div>
  </div>


<!-- Modal BtnRemoveAccount-->
<form method="post" action="?p=removeaccount" >
<?php echo csrf_field(); ?>
<div class="modal fade" id="BtnRemoveAccount" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Remove Account Confirmation</h4>
      </div>
      <div class="modal-body">
        <div class="checkbox">
          <label>By pressing '<code>Remove Now</code>' button you will understand that your account will be removed permenantly.</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" name="remove_now" class="btn btn-danger">Remove Now</button>
      </div>
    </div>
  </div>
</div>
</form>
