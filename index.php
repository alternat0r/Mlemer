<?php
	require_once "inc/config.php";
	require_once "inc/lib.php";

	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}

	$start = explode(' ', microtime())[0] + explode(' ', microtime())[1];

	$page = "";
	$page_name = "Dashboard";
	if ( isset( $_REQUEST['p'] ) ) {
		$page = strip_tags( (string) $_REQUEST['p'] );

		if ( $page == "about" ) { $page_name = "About"; }
		if ( $page == "dash" or $page == "home" or $page == "" ) { $page_name = "Dashboard"; }
		if ( $page == "register" ) { $page_name = "Register"; }
		if ( $page == "login" ) { $page_name = "Login"; }
		if ( $page == "account" ) { $page_name = "Account"; }
		if ( $page == "exercise" ) { $page_name = "Exercise"; }
		if ( $page == "play" ) { $page_name = "Exercise"; }
	}

	// Pages reachable without being logged in.
	$public_pages = [ 'login', 'register', 'about' ];

	if ( is_logged_in() && in_array( $page, [ 'login', 'register' ], true ) ) {
		// Already have an account - no need to see the login/register forms again.
		header( "Location: ?p=home" );
		exit;
	}

	if ( !is_logged_in() && !in_array( $page, $public_pages, true ) ) {
		header( "Location: ?p=login" );
		exit;
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
		<link rel="shortcut icon" type="image/png" href="img/favicon.png" />

<?php
	include "inc/header.php";
?>
	</head>
	<body>

		<div class="container">
			<?php include "inc/nav.php"; ?>

			<?php
				if ( !empty( $page ) ) {
					if ( $page == "dashboard" or $page == "home") {
						include "dash.php";
					} elseif ( $page == "about" ) {
						include "about.php";
					} elseif ( $page == "register" ) {
						include "register.php";
					} elseif ( $page == "login" ) {
						include "login.php";
					} elseif ( $page == "account" ) {
						include "account.php";
					} elseif ( $page == "removeaccount" ) {
						include "remove.php";
					} elseif ( $page == "play" ) {
						include "play.php";
					} elseif ( $page == "logout" ) {
						include "logout.php";
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
