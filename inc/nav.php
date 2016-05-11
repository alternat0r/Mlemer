<?php
    require_once "inc/config.php";
    require_once "inc/lib.php";
    
?>

<!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="?p=home"><strong><?php echo GetProductName(); ?></strong></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <?php
                $curr_ip = @getHostByName(getHostName());
                $curr_uid = GenUniqueID(); //UniqueMachineID();
                $curr_hostname = getenv('COMPUTERNAME');
                if ( do_they_register_yet( $curr_ip, $curr_hostname, $curr_uid ) == false ) {
                  echo '<li><a href="?p=register">Register</a></li>';
                }

                if ( do_they_register_yet( $curr_ip, $curr_hostname, $curr_uid ) == true ) {
                  echo '<li><a href="?p=about">About</a></li>';
                }
              ?>
              
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php
                if ( do_they_register_yet( $curr_ip, $curr_hostname, $curr_uid ) == true ) {
                  echo '<li><a href="#">Welcome <strong>'.get_current_user_realname().'</strong></a></li>';
                  echo '<li><a href="?p=account"><strong>Account</strong></a></li>';
                }
              ?>
              <!-- <li class="divider-vertical"><a href="?p=logout"><strong>Log Out</strong></a></li> -->
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>