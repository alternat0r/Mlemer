<?php 
	if(isset($_SESSION['login_user'])) {
		echo "STILL LOGGED IN" . $_SESSION['login_user'];
	}
?>
<p>
	<h2 class="page-header">About <?php echo $pg_title; ?></h2>
	<?php echo $pg_about; ?>
</p>