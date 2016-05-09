<?php
	require_once "./inc/config.php";

	//require_once "../inc/header.php";
?>
	<h2 class="page-header">Configuration</h2>
	<form action="" method="post">
		<div class="form-group">
    		<label for="pg_productname">Product Name</label>
    		<input class="form-control" id="pg_productname" placeholder="Product Name">
  		</div>

		<div class="form-group">
    		<label for="pg_title">Title</label>
    		<input class="form-control" id="pg_title" placeholder="Page Title">
  		</div>
  		<div class="form-group">
    		<label for="pg_company">Company Name</label>
    		<input class="form-control" id="pg_company" placeholder="Company Name">
  		</div>
		<div class="form-group">
			<label for="pg_about">About</label>
			<textarea id="pg_about" class="form-control" rows="3"></textarea>	
  		</div>
  		<button type="submit" class="btn btn-default">Save Changes</button>
  	</form>



