<?php
    require_once "./inc/config.php";
    require_once "../inc/lib.php";

    if ( isset( $_REQUEST['pg_productname'] ) or isset( $_REQUEST['pg_title'] ) ) {
      $pg_productname = $_REQUEST['pg_productname'];
      $pg_title = $_REQUEST['pg_title'];
      $pg_company = $_REQUEST['pg_company'];
      $pg_about = $_REQUEST['pg_about'];

      //TODO: Update DB.
      update_config( $pg_productname, $pg_title, $pg_company, $pg_about );
      echo error_msg( "success", "Configuration successfully updated." );
    }

?>
	<h2 class="page-header">Configuration</h2>
	<form action="" method="post">
		<div class="form-group">
    		<label for="pg_productname">Product Name</label>
    		<input class="form-control" name="pg_productname" id="pg_productname" placeholder="Product Name" value="<?php echo GetProductName(); ?>" required="true">
  		</div>

		<div class="form-group">
    		<label for="pg_title">Title</label>
    		<input class="form-control" name="pg_title" id="pg_title" placeholder="Page Title" value="<?php echo GetTitle(); ?>" required="true">
  		</div>
  		<div class="form-group">
    		<label for="pg_company">Company Name</label>
    		<input class="form-control" name="pg_company" id="pg_company" placeholder="Company Name" value="<?php echo GetCompanyName(); ?>" required="true">
  		</div>
		<div class="form-group">
			<label for="pg_about">About</label>
			<textarea id="pg_about" name="pg_about" class="form-control" rows="5" placeholder="General description about the exercise or event." required="true"><?php echo GetAbout(); ?></textarea>	
  		</div>
      <div class="text-right">
  		  <button type="submit" name="pgConfigSave" class="btn btn-primary">Save Changes</button>
      </div>
  	</form>