<?php
	$start = explode(' ', microtime())[0] + explode(' ', microtime())[1];

	require_once "../inc/config.php";
	require_once "../inc/lib.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}

	$page = "";
	$page_name = "Dashboard";
	if ( isset( $_REQUEST['p'] ) ) {
		$page = strip_tags( (string) $_REQUEST['p'] );

		if ( $page == "about" ) { $page_name = "About"; }
		if ( $page == "dash" or $page == "home" or $page == "" ) { $page_name = "Dashboard"; }
		if ( $page == "config" ) { $page_name = "Config"; }
		if ( $page == "manager" ) { $page_name = "Manager"; }
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
				echo '<title>' . e( GetTitle() ) . ' - ' . e( $page_name ) . '</title>' . PHP_EOL;
			} else {
				echo '<title>' . e( GetTitle() ) . '</title>' . PHP_EOL;
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

				// Destructive admin actions must be POST + CSRF-verified.
				if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
					if ( isset( $_POST['catid'] ) ) {
						csrf_verify();
						admin_del_category( (int) $_POST['catid'] );
						header("Location: ?p=category");
						exit;
					}

					if ( isset( $_POST['exerid'] ) ) {
						csrf_verify();
						admin_del_exercise( (int) $_POST['exerid'] );
						header("Location: ?p=exercise");
						exit;
					}
					if ( isset( $_POST['questid'] ) ) {
						csrf_verify();
						admin_del_question( (int) $_POST['questid'] );
						header("Location: ?p=quest");
						exit;
					}

					if ( isset( $_POST['deluid'] ) ) {
						csrf_verify();
						admin_del_user( (int) $_POST['deluid'] );
						header("Location: ?p=users");
						exit;
					}
				}


				if ( !empty( $page ) ) {
					if ( $page == "dashboard" or $page == "home") {
						include "../dash.php";
					} elseif ( $page == "about" ) {
						include "../about.php";
					} elseif ( $page == "usermode" ) {
						header('Location: ../');
						exit;
					} elseif ( $page == "config" ) {
						include "admin_config.php";
					} elseif ( $page == "manager" ) {
						include "admin_manager.php";
					} elseif ( $page == "users" ) {
						include "admin_users.php";
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
