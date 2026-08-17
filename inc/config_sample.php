<?php
	// Copy this file to inc/config.php and fill in your own values.
	// inc/config.php is gitignored - never commit real credentials.

	error_reporting( 0 );

	// Set to "true" only on a local/dev install. Must be "false" in production:
	// it controls whether PHP errors are displayed to visitors.
	define( "ENABLE_ERROR_MSG", "false" );

	if ( session_status() === PHP_SESSION_NONE ) {
		session_set_cookie_params( [
			'lifetime' => 0,
			'path'     => '/',
			'httponly' => true,
			'samesite' => 'Lax',
			'secure'   => !empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off',
		] );
		session_start();
	}

	$user_name = "<CHANGEME>";
	$password  = "<CHANGEME>";
	$database  = "<CHANGEME>";
	$server    = "<CHANGEME>";

	global $pg_title;
	global $pg_company;
	global $pg_about;

	$link = mysqli_connect( $server, $user_name, $password, $database );

	if ( !$link ) {
		error_log( "Mlemer: MySQL connection failed: " . mysqli_connect_error() );
		http_response_code( 500 );
		die( "Service temporarily unavailable. Please try again later." );
	}

	mysqli_set_charset( $link, "utf8mb4" );

	$result = mysqli_query( $link, "SELECT pg_title, pg_company, pg_about FROM config LIMIT 1" );
	$row = $result ? mysqli_fetch_assoc( $result ) : [];

	$pg_title   = $row['pg_title'] ?? '';
	$pg_company = $row['pg_company'] ?? '';
	$pg_about   = $row['pg_about'] ?? '';
?>
