<?php
	require_once "inc/config.php";

	if ( isset( $_REQUEST['p'] ) ) {
		$page = mysqli_real_escape_string( $link, $_REQUEST['p'] );

		if ( $page == "about" ) { $page_name = "About"; }
		if ( $page == "dash" or $page == "home" or $page == "" ) { $page_name = "Dashboard"; }
		if ( $page == "config" ) { $page_name = "Config"; }
		if ( $page == "manager" ) { $page_name = "Manager"; }
		if ( $page == "register" ) { $page_name = "Register"; }
		if ( $page == "login" ) { $page_name = "Login"; }
	}
?>
<html>
	<head>
		<?php
			if ( isset( $page_name ) ) {
				echo '<title>' . $pg_title . ' - ' . $page_name . '</title>' . PHP_EOL;
			} else {
				echo '<title>' . $pg_title . '</title>' . PHP_EOL;
			}
		?>
		<link rel="shortcut icon" type="image/png" href="img/favicon.png" />

<?php
	include "inc/header.php";
?>
	</head>
	<body>

		<div class="container">
			<?php include "inc/nav.php"; ?>

			<?php
				if ( isset($page) && !empty($page) ) {
					if ( $page == "dashboard" or $page == "home") {
						include "dash.php";
					} elseif ( $page == "about" ) {
						include "about.php"; 
					} elseif ( $page == "register" ) {
						include "register.php"; 
					} elseif ( $page == "login" ) {
						include "login.php"; 
					} elseif ( $page == "config" ) {
						include "admin/admin_config.php"; 
					} else {
						include "dash.php";
					}
				} else {
					include "dash.php"; 
				}
				
			?>
			<?php include "inc/footer.php"; ?>
	</body>
</html>