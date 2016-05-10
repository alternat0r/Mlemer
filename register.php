<?php 
	require_once "inc/lib.php";

	$curr_ip = getHostByName(getHostName());
    $curr_hostname = gethostname();
    $curr_uid = GenUniqueID(); 

	if ( do_they_register_yet( $curr_ip, $curr_hostname, $curr_uid ) == true ) {
		echo '<META http-equiv="refresh" content="0;URL=http://'.$curr_url['path'].'?p=home">';
	}

	global $link;
	if ( isset( $_REQUEST['submit'] ) ) {
		if ( isset( $_REQUEST['username'] ) && isset( $_REQUEST['realname'] ) && isset( $_REQUEST['password'] ) ) {
			$regUsername = mysqli_real_escape_string( $link, $_REQUEST['username'] );
			$regRealname = mysqli_real_escape_string( $link, $_REQUEST['realname'] );
			$regPassword = mysqli_real_escape_string( $link, $_REQUEST['password'] );
			$curr_ip = @$_SERVER['REMOTE_ADDR'];
			$curr_uid = GenUniqueID();
			mysqli_query( $link, "UPDATE users SET user_loginname='$regUsername', user_realname='$regRealname',user_password='$regPassword' WHERE user_uid='$curr_uid'");
			//echo "SUCCESSFULLY REGISTER!";
			echo '<META http-equiv="refresh" content="0;URL=http://'.$curr_url['path'].'?p=home">';
			setcookie( "stayalive", $curr_uid, time() + 777600 ); // 9 days to live

		}
	}
?>
<p>
	<h2 class="page-header">
		Register
		<small>You need to register first in order to proceed.</small>
	</h2>

	<form class="form-horizontal" action="" method="post">
	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
	    <div class="col-sm-10">
	      <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="User Name" required="true">
	    </div>
	  </div>
  	  <div class="form-group">
	    <label for="inputEmail3" class="col-sm-2 control-label">Real Name</label>
	    <div class="col-sm-10">
	      <input type="text" name="realname" class="form-control" id="inputEmail3" placeholder="Real Name" required="true">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
	    <div class="col-sm-10">
	      <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password (Optional)">
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" name="submit" class="btn btn-default">Register</button>
	    </div>
	  </div>
	</form>
</p>