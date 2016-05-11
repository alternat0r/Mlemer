<?php
    require_once "inc/config.php";    
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
            <a class="navbar-brand" href="?p=home"><strong><?php echo GetProductName(); ?></strong></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="?p=usermode">UserMode</a></li>
              <li><a href="?p=about">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="?p=users"><strong>Users</strong></a></li>
              <li><a href="?p=config"><strong>Config</strong></a></li>
              <li><a href="?p=exercise"><strong>Manager</strong></a></li>
              <!-- <li class="divider-vertical"><a href="?p=logout"><strong>Log Out</strong></a></li> -->
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>