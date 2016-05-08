<?php
	require_once "inc/config.php";
?>
<html>
	<head>
		<title><?php echo $pg_title; ?></title>
		<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>

<?php
	include "inc/header.php";
	$page = mysqli_real_escape_string( $link, $_REQUEST['p'] );
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