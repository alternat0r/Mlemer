<?php

    
	require_once "inc/config.php";
	require_once "../inc/lib.php";

	$start = explode(' ', microtime())[0] + explode(' ', microtime())[1];

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
		if ( $page == "category" ) { $page_name = "Category"; }
	}
?>
<html>
	<head>
		<?php
			if ( isset( $page_name ) ) {
				echo '<title>' . GetTitle() . ' - ' . $page_name . '</title>' . PHP_EOL;
			} else {
				echo '<title>' . GetTitle() . '</title>' . PHP_EOL;
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

				if ( isset( $_REQUEST['catid'] ) ) {
					$catid = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['catid'] ) );
					admin_del_category( $catid );
					header("Location: ?p=category");
				}

				if ( isset( $_REQUEST['exerid'] ) ) {
					$exerid = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['exerid'] ) );
					admin_del_exercise( $exerid );
					header("Location: ?p=exercise");
				}
				if ( isset( $_REQUEST['questid'] ) ) {
					$questid = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['questid'] ) );
					admin_del_question( $questid );
					header("Location: ?p=quest");
				}

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
					} elseif ( $page == "category" ) {
						include "admin_category.php";
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