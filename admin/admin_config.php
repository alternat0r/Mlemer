<?php
    	require_once "../inc/config.php";
    	require_once "../inc/lib.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}

	if ( isset( $_POST['pg_productname'] ) or isset( $_POST['pg_title'] ) ) {
	      csrf_verify();

	      $pg_productname = strip_tags( (string) ( $_POST['pg_productname'] ?? '' ) );
	      $pg_title = strip_tags( (string) ( $_POST['pg_title'] ?? '' ) );
	      $pg_company = strip_tags( (string) ( $_POST['pg_company'] ?? '' ), "<a>" );
	      $pg_about = strip_tags( (string) ( $_POST['pg_about'] ?? '' ), "<a>" );

	      //TODO: Update DB.
	      update_config( $pg_productname, $pg_title, $pg_company, $pg_about );
	      echo error_msg( "success", "SUCCESS!", "Configuration successfully updated." , "1");
	}

?>
	<h2 class="page-header">Configuration</h2>
	<form action="?p=config" method="post">
		<?php echo csrf_field(); ?>
		<div class="form-group">
    		<label for="pg_productname">Product Name</label>
    		<input class="form-control" name="pg_productname" id="pg_productname" placeholder="Product Name" value="<?php echo e( GetProductName() ); ?>" required="true">
  		</div>

		<div class="form-group">
    		<label for="pg_title">Title</label>
    		<input class="form-control" name="pg_title" id="pg_title" placeholder="Page Title" value="<?php echo e( GetTitle() ); ?>" required="true">
  		</div>
  		<div class="form-group">
    		<label for="pg_company">Company Name</label>
    		<input class="form-control" name="pg_company" id="pg_company" placeholder="Company Name" value="<?php echo e( GetCompanyName() ); ?>" required="true">
  		</div>
		<div class="form-group">
			<label for="pg_about">About</label>
			<textarea id="pg_about" name="pg_about" class="form-control" rows="5" placeholder="General description about the exercise or event OR leave it empty for default information."><?php echo e( GetAbout() ); ?></textarea>
  		</div>
      <div class="text-right">
  		  <button type="submit" name="pgConfigSave" class="btn btn-primary">Save Changes</button>
      </div>
  	</form>
