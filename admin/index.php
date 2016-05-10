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
		if ( $page == "users" ) { $page_name = "Users"; }
		if ( $page == "quest" ) { $page_name = "Questionaire"; }
		if ( $page == "exercise" ) { $page_name = "Exercise"; }
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
		<link rel="shortcut icon" type="image/png" href="../img/favicon.png" />

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
						include "../dash.php";
					} elseif ( $page == "about" ) {
						include "../about.php"; 
					} elseif ( $page == "usermode" ) {
						header('Refresh: 0; URL = ../');
					} elseif ( $page == "register" ) {
						include "register.php"; 
					} elseif ( $page == "login" ) {
						include "../login.php"; 
					} elseif ( $page == "config" ) {
						include "admin_config.php"; 
					} elseif ( $page == "manager" ) {
						include "admin_manager.php"; 
					} elseif ( $page == "users" ) {
						include "admin_users.php";
					} elseif ( $page == "logout" ) {
						include "logout.php";
					} elseif ( $page == "exercise" ) {
						include "admin_exercise.php";
					} elseif ( $page == "quest" ) {
						include "admin_quest.php";
					} else {
						include "../dash.php";
					}
				} else {
					include "../dash.php"; 
				}
				
			?>
			<?php include "inc/footer.php"; ?>
	</body>
</html>