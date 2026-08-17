<?php
    require_once "inc/config.php";
    require_once "inc/lib.php";
?>

<!-- Static navbar -->
      <nav class="navbar navbar-custom">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?p=home"><strong><?php echo e( GetProductName() ); ?></strong></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <?php
                if ( !is_logged_in() ) {
                  echo '<li><a href="?p=register">Register</a></li>';
                } else {
                  echo '<li><a href="?p=dash">Dashboard</a></li>';
                  echo '<li><a href="?p=about">About</a></li>';
                }
              ?>

            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php
                if ( is_logged_in() ) {
                  echo '<li><a href="?p=account">Welcome <strong>'.e( get_current_user_realname() ).'</strong></a></li>';
                  echo '<li><a href="?p=account"><strong>Account</strong></a></li>';
                  echo '<li><a href="?p=logout"><strong>Log Out</strong></a></li>';
                }
              ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

      <div style="margin-top: -20px;"></div>
