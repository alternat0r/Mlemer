<?php
	$exer_id = $_REQUEST['e'];

	$sql = "SELECT * FROM exercise WHERE id='$exer_id';";
	$result = mysqli_query( $link, $sql );
	$row = mysqli_fetch_assoc( $result );
	$exer_name = $row['exer_name'];
?>

<h2 class="page-header"><?php echo $exer_name; ?></h2>

<h3 class="sub-header">Question</h3>