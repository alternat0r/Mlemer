<?php
	
?>
	<h2 class="page-header">
		Account
		<small>Here you can change password, username or remove account.</small>
	</h2>

	<form action="" method="post">
		<div class="form-group">
    		<label for="pg_productname">Username</label>
    		<input class="form-control" id="pg_productname" placeholder="Your user name for login purpose">
  		</div>

		<div class="form-group">
    		<label for="pg_title">Real Name</label>
    		<input class="form-control" id="pg_title" placeholder="Your Real Name">
  		</div>
  		<div class="form-group">
    		<label for="pg_company">Password</label>
    		<input class="form-control" id="pg_company" type="password" placeholder="Enter new password to change. Otherwise, leave it.">
  		</div>
  		<div class="text-right">
  			<button type="submit" class="btn btn-primary">Save Changes</button>
  		</div>
  	</form>

	<div class="bs-callout bs-callout-danger" id="callout-input-needs-type">
		<h4>Remove Account</h4>
		<p>Here you can remove your current account if you want to re-register.</p>
    <a href="?p=removeaccount" class="btn btn-danger">Remove Account</a>
	</div>

