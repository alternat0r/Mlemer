<?php
	require_once "inc/config.php";
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
	}

	function UniqueMachineID($salt = "") {
	    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
	        $temp = sys_get_temp_dir().DIRECTORY_SEPARATOR."diskpartscript.txt";
	        if(!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");
	        $output = shell_exec("diskpart /s ".$temp);
	        $lines = explode("\n",$output);
	        $result = array_filter($lines,function($line) {
	            return stripos($line,"ID:")!==false;
	        });
	        if(count($result)>0) {
	            $result = @array_shift(array_values($result));
	            $result = explode(":",$result);
	            $result = trim(end($result));       
	        } else $result = $output;       
	    } else {
	        $result = shell_exec("blkid -o value -s UUID");  
	        if(stripos($result,"blkid")!==false) {
	            $result = $_SERVER['HTTP_HOST'];
	        }
	    }   
	    return md5($salt.md5($result));
	}

	function check_data( $ip, $hostname, $uid ) {
		global $link;
		$query = mysqli_query($link, "SELECT * FROM users WHERE (user_ip='".$ip."' AND user_hostname='".$hostname."' AND user_uid='".$uid."')");

		if(mysqli_num_rows($query) > 0) {
    		return true;
		}else{	
    		if (!mysqli_query($link,$query)) {
        		//die('Error: ' . mysqli_error($link));
        		return false;
    		}
		}
	}

	function do_they_register_yet( $ip, $hostname, $uid ) {
		global $link;
		$query = mysqli_query( $link, "SELECT * FROM users WHERE (user_ip='".$ip."' AND user_hostname='".$hostname."' AND user_uid='".$uid."' AND user_loginname IS NOT NULL)" );

		if ( mysqli_num_rows( $query ) > 0 ) {
    		return true;
		} else {
			global $link;
    		if ( @!mysqli_query( $link, $query ) ) {
        		return false;
    		}
		}
	}

	$curr_ip = @$_SERVER['REMOTE_ADDR'];
	$curr_uid = UniqueMachineID();
    $curr_hostname = getenv('COMPUTERNAME');
    //$machname = gethostname();

    $curr_url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $curr_url = parse_url($curr_url);
    //var_dump( $curr_url );
    //echo $curr_url['path'];
   
    //echo $curr_uid."\n".$curr_ip."\n".$hostname."\n".$curr_hostname;

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
				}
			
		} else {
			// already register, proceed to main page
		}
	}

	//mysqli_query( $link, "INSERT INTO users (`user_ip`,`user_hostname`,`user_uid`) VALUES ('".$curr_ip."','".$curr_hostname."','".$curr_uid."')" );

	
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
					} elseif ( $page == "manager" ) {
						include "admin/admin_manager.php"; 
					} elseif ( $page == "account" ) {
						include "account.php";
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