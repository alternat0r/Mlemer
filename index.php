<?php
	require_once "inc/config.php";
	require_once "inc/lib.php";

	if (isset($_COOKIE["stayalive"])) {
		//echo $_COOKIE["stayalive"];	
	} else {
		//echo "NO COOKIE SET!";
	}

	$start = explode(' ', microtime())[0] + explode(' ', microtime())[1];
	

	//error_reporting(0);
	if ( isset( $_REQUEST['p'] ) ) {
		$page = mysqli_real_escape_string( $link, $_REQUEST['p'] );

		if ( $page == "about" ) { $page_name = "About"; }
		if ( $page == "dash" or $page == "home" or $page == "" ) { $page_name = "Dashboard"; }
		if ( $page == "config" ) { $page_name = "Config"; }
		if ( $page == "manager" ) { $page_name = "Manager"; }
		if ( $page == "register" ) { $page_name = "Register"; }
		if ( $page == "login" ) { $page_name = "Login"; }
		if ( $page == "account" ) { $page_name = "Account"; }
		if ( $page == "exercise" ) { $page_name = "Exercise"; }
		if ( $page == "play" ) { $page_name = "Exercise"; }
	}

	$curr_ip = getHostByName(getHostName()); // @$_SERVER['REMOTE_ADDR'];
	$curr_uid = GenUniqueID(); //UniqueMachineID();
    $curr_hostname = gethostname();

    $curr_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $curr_url = parse_url($curr_url);

	if ( check_data( $curr_ip, $curr_hostname, $curr_uid ) == false ) {
		//echo "data not exist, proceed auto-register";
		mysqli_query( $link, "INSERT INTO users (`user_ip`,`user_hostname`,`user_uid`) VALUES ('".$curr_ip."','".$curr_hostname."','".$curr_uid."')" );
		echo '<META http-equiv="refresh" content="0;URL=http://'.$curr_url['path'].'?p=home">';
	} else {
		//echo "data exist";

		if ( do_they_register_yet( $curr_ip, $curr_hostname, $curr_uid ) == false ) {
			//echo "not yet, proceed register";
				if ( @$page_name == "Register" ) {
					//echo "DO NOTHIGN";
				} else {
					echo '<META http-equiv="refresh" content="0;URL=http://'.$curr_url['path'].'?p=register">';
					die(""); // dirty trick
				}
			
		} else {
			// already register, proceed to main page
		}
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
						if ( do_they_register_yet( $curr_ip, $curr_hostname, $curr_uid ) == true ) {
							echo '<META http-equiv="refresh" content="0;URL=http://'.$curr_url['path'].'?p=home">';
						} else {
							include "register.php"; 	
						}
					} elseif ( $page == "login" ) {
						include "login.php"; 
					} elseif ( $page == "config" ) {
						include "admin/admin_config.php"; 
					} elseif ( $page == "manager" ) {
						include "admin/admin_manager.php"; 
					} elseif ( $page == "exercise" ) {
						include "admin/admin_exercise.php"; 
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