<?php
    require_once "./inc/config.php";
    require_once "../inc/lib.php";

    if ( isset( $_REQUEST['pg_productname'] ) or isset( $_REQUEST['pg_title'] ) ) {
      $pg_productname = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['pg_productname'] ) );
      $pg_title = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['pg_title'] ) );
      $pg_company = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['pg_company'] ), "<a>");
      $pg_about = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['pg_about'] ) , "<a>");
      
      if ( empty( $pg_about ) ) {
      	$pg_about = "";
      }
      
      //TODO: Update DB.
      update_config( $pg_productname, $pg_title, $pg_company, $pg_about );
      echo error_msg( "success", "SUCCESS!", "Configuration successfully updated." , "1");
    }

?>
	<h2 class="page-header">Configuration</h2>
	<form action="" method="post">
		<div class="form-group">
    		<label for="pg_productname">Product Name</label>
    		<input class="form-control" name="pg_productname" id="pg_productname" placeholder="Product Name" value="<?php echo htmlentities( GetProductName() ); ?>" required="true">
  		</div>

		<div class="form-group">
    		<label for="pg_title">Title</label>
    		<input class="form-control" name="pg_title" id="pg_title" placeholder="Page Title" value="<?php echo htmlentities( GetTitle() ); ?>" required="true">
  		</div>
  		<div class="form-group">
    		<label for="pg_company">Company Name</label>
    		<input class="form-control" name="pg_company" id="pg_company" placeholder="Company Name" value="<?php echo htmlentities( GetCompanyName() ); ?>" required="true">
  		</div>
		<div class="form-group">
			<label for="pg_about">About</label>
			<textarea id="pg_about" name="pg_about" class="form-control" rows="5" placeholder="General description about the exercise or event."><?php echo htmlentities( GetAbout() ); ?></textarea>	
  		</div>
      <div class="text-right">
  		  <button type="submit" name="pgConfigSave" class="btn btn-primary">Save Changes</button>
      </div>
  	</form>
