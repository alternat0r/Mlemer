<?php 
	require_once "inc/config.php";
	
	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}
	
	if(isset($_SESSION['login_user'])) {
		echo "STILL LOGGED IN" . $_SESSION['login_user'];
	}
	
	if ( empty( $pg_about ) ) {
		$about = "<div class=\"row\">";
  		$about .= "<div class=\"col-md-6\">";
		$about .= "<div class=\"bs-callout bs-callout-info hoverDiv\" id=\"callout-input-needs-type\">\n";
		$about .= "	<h4>About</h4>";
		$about .= "	<p>";
		$about .= "		Mlemer is a quiz, exercise, CTF or questionnaire system designed for trainer. It is designed meant to be simplified and easy to manage. This system is not suitable to be used for public access. It is designed for local network only and to assist trainer. Used at your own risk.";
		$about .= "	</p>\n";
		$about .= "</div>\n";
		$about .= "</div>";
		$about .= "<div class=\"col-md-6\">";
		$about .= "<div class=\"bs-callout bs-callout-info hoverDiv\" id=\"callout-input-needs-type\">\n";
		$about .= "	<h4>Credit</h4>";
		$about .= "	<p>";
		$about .= " 	<ul>";
		$about .= "		<li>Twitter Bootstrap v3.3.6</li>";
	     	$about .= "		<li>Dashboard Statistic inspired by SB Admin v2.0.</li>";
	     	$about .= "		<li>Jquery</li>";
	     	$about .= " 	<ul>";
		$about .= "	</p>\n";
		$about .= "</div>\n";
		$about .= "</div>";
		$about .= "</div>";
	} else {
		$about = $pg_about;
	}
?>
<p>
	<h2 class="page-header">About <?php echo $pg_title; ?></h2>
	<?php echo $about; ?>
</p>
