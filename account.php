<?php
	require_once "inc/lib.php";
	require_once "inc/config.php";
	
	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}

    $curr_ip = getHostByName(getHostName());
      $curr_hostname = gethostname();
      $curr_uid = GenUniqueID(); 

    /*if ( do_they_register_yet( $curr_ip, $curr_hostname, $curr_uid ) == true ) {
      echo '<META http-equiv="refresh" content="0;URL=http://'.$curr_url['path'].'?p=home">';
    }*/

    global $link;
    if ( isset( $_REQUEST['submit'] ) ) {
      if ( isset( $_REQUEST['username'] ) && isset( $_REQUEST['realname'] ) && isset( $_REQUEST['password'] ) ) {

        if ( isset( $_REQUEST['username'] ) or isset( $_REQUEST['password'] ) ) {
          $regUsername = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['username'] ) );
          $regRealname = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['realname'] ) );
          $regPassword = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['password'] ) );
        }

        $curr_ip = @$_SERVER['REMOTE_ADDR'];
        $curr_uid = GenUniqueID();
        mysqli_query( $link, "UPDATE users SET user_loginname='$regUsername', user_realname='$regRealname',user_password='$regPassword' WHERE user_uid='$curr_uid'");
        //echo "SUCCESSFULLY REGISTER!";
        echo '<META http-equiv="refresh" content="0;URL=http://'.$curr_url['path'].'?p=account">';
        setcookie( "stayalive", $curr_uid, time() + 777600 ); // 9 days to live

      }
    }
?>
	<h2 class="page-header">
		Account
		<small>Here you can change password, username or remove account.</small>
	</h2>

  <div class="row">
    <div class="col-md-6">
      <form action="" method="post">
        <div class="form-group">
            <label for="pg_productname">Username</label>
            <input class="form-control" name="username" id="pg_productname" placeholder="Your user name for login purpose" value="<?php echo get_current_username(); ?>">
          </div>

        <div class="form-group">
            <label for="pg_title">Real Name</label>
            <input class="form-control" name="realname" id="pg_title" placeholder="Your Real Name (Your name will be displayed)" value="<?php echo get_current_user_realname(); ?>" required="true">
          </div>
          <div class="form-group">
            <label for="pg_company">Password</label>
            <input class="form-control" name="password" id="pg_company" type="password" placeholder="Enter a new password to change. Otherwise, leave it." value="<?php echo get_current_userpassword(); ?>">        
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


