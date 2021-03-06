<?php
	require_once "inc/config.php";
	
	if ( ENABLE_ERROR_MSG == "true" ) {
		error_reporting( E_ALL );
	} else {
	    	error_reporting( 0 );
	}

?>
			<h2 class="page-header">Dashboard</h2>
			
			<style>
				.hoverDiv:hover { background: #E0F2F7; }
				.NoUnderLine { text-decoration: none !important; }

			</style>
			<div style="margin-top: -10px"></div>

			<link rel="stylesheet" href="css/sb-admin-2.css">
			<link rel="stylesheet" href="../css/sb-admin-2.css"> <!-- Admin page -->
			<style>
				body {
					background-color: white;
				}
			</style>

			<div class="row">
                <div class="col-md-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        	<div class="row">
	                            <div class="col-xs-3">
	                                <i class="fa fa-tasks fa-5x"></i>
	                            </div>
	                            <div class="col-xs-9 text-right">
									<div class="huge"><?php echo count_total_available_question(); ?></div>
									<div>Total Question</div>
	                            </div>
                            </div>
                        </div>
                  
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo count_total_question_taken(); ?></div>
                                    <div>Question Taken</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo count_registered_user(); ?></div>
                                    <div>Total Player</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="col-md-3">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php echo calculate_point(); ?></div>
                                    <div>Cumulative Point</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
            </div>

			<div class="row">
  				<div class="col-md-6">
  					<h3 class="sub-header">Available Exercise</h3>
  					<div style="margin-top: -9px">
  					<?php
		              	$sql = "SELECT * FROM exercise";
		              	$user_count = "";
						$result = mysqli_query( $link, $sql );
						while( $row = @mysqli_fetch_assoc( $result ) ) {
							if ( $row['activated'] == "1" ) {
								$user_count++;
								$exer_name =  strip_tags( mysqli_real_escape_string( $link, $row['exer_name'] ) );
								$exer_desc =  strip_tags( mysqli_real_escape_string( $link, $row['exer_description'] ) );
								echo "<div class=\"bs-callout bs-callout-info hoverDiv\" id=\"callout-input-needs-type\">\n";
								echo "<a class=\"NoUnderLine\" href=\"javascript:void(0)\" onclick=\"window.location.href='?p=play&e=".$row['id']."'\">";
								echo "	<h4>" . $exer_name . "</h4>";
								echo "	<p>" . $exer_desc . "</p>\n";
								echo "</a>";
								echo "</div>\n";
								
							}
						}
						if ( $user_count == 0 ) {
							echo error_msg( "warning", "OPS!", "No exercise available. Contact administrator." , "0");
						}
					?>
					</div>
  				</div>
  				<div class="col-md-6">
					<h3 class="sub-header">Player List</h3>
			        <div class="table-responsive">
				        <div class="panel panel-default">
				            <table id="topscore" class="table table-hover table-bordered">
				              <thead>
				                <tr>
				                  <th style="text-align: center;">#</th>
				                  <th>Player Name</th>
				                  <th style="text-align: center;">Point</th>
				                </tr>
				              </thead>
				              <tbody>
				              <?php
					              	$sql = "SELECT * FROM users ORDER BY user_point DESC";
					              	$user_count = "";
									$result = mysqli_query( $link, $sql );
									while( $row = mysqli_fetch_assoc( $result ) ) {
										$user_count++;
										if ( $row['user_realname'] != "Administrator" and $row['user_realname'] != "" ) {
											echo "<tr>\n";
											echo "	<td style=\"text-align: center;\">" . $user_count . "</td>\n";
											echo "	<td>" . $row['user_realname'] . "</td>\n";
											echo "	<td data-sortable=\"true\" style=\"text-align: center;\">".get_perplayer_total_point( $row['id'] )."</td>\n";
											echo "</tr>\n";
										}
									}
				              ?>
				              </tbody>
				            </table>
				        </div>
					</div>
  				</div>
			</div>
			

