<?php 
	if(isset($_SESSION['login_user'])) {
		echo "STILL LOGGED IN" . $_SESSION['login_user'];
	}
	
	if ( empty( $pg_about ) ) {
		$about = "<div class=\"bs-callout bs-callout-info hoverDiv\" id=\"callout-input-needs-type\">\n";
		$about .= "<a class=\"NoUnderLine\" href=\"javascript:void(0)\" onclick=\"window.location.href='?p=play&e=".$row['id']."'\">";
		$about .= "	<h4>About</h4>";
		$about .= "	<p>";
		$about .= "		Mlemer is a quiz, exercise, CTF or questionnaire system designed for trainer. It is designed meant to be simplified and easy to manage. This system is not suitable to be used for public access. It is designed for local network only and to assist trainer. Used at your own risk.";
		$about .= "	</p>\n";
		$about .= "</a>";
		$about .= "</div>\n";
	} else {
		$about = $pg_about;
	}
?>
<p>
	<h2 class="page-header">About <?php echo $pg_title; ?></h2>
	<?php echo $about; ?>
</p>
