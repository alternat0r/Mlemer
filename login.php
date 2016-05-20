<?php
    error_reporting(0);
    
    if ( isset( $_POST['submit'] ) ) {
      if ( empty( $_POST['username'] ) || empty( $_POST['password'] ) ) {
        error_msg( "danger", "OPS!", "Username or Password is invalid" , "1");
      } else {
        $username = $_REQUEST['username'];
        $_SESSION['login_user'] = $username;
        //session_start();

        //header("location: ?p=home");
      }
    }
?>

<h2 class="page-header">Login</h2>

<form class="form-horizontal" action="" method="post">
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
      <div class="checkbox">
        <label>
          <input type="checkbox"> Remember me
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="submit" class="btn btn-default">Sign in</button>
    </div>
  </div>
</form>
