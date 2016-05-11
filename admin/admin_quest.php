<h2 class="page-header">Manager</h2>

<ul class="nav nav-tabs">
  <li role="presentation"><a href="?p=exercise">Exercise</a></li>
  <li role="presentation" class="active"><a href="?p=quest">Questionaire</a></li>
</ul>
	<form action="?p=home" method="post">
	<label for="selectE"><h3 class="sub-header">Select Exercise:</h3></label>
	<div class="selectContainer">
        <select id="selectE" class="form-control" onchange='if(this.value != 0) { this.form.submit(); }'>
        	<?php
              	$sql = "SELECT * FROM exercise";
              	$user_count = "";
				$result = mysqli_query( $link, $sql );
				while( $row = @mysqli_fetch_assoc( $result ) ) {
					$user_count++;
					if ( $user_count == 1 ) {
						echo "	<option value=\"".$row['id']."\" selected=\"selected\">" . $row['exer_name'] . "</option>\n";
					} else {
						echo "	<option value=\"".$row['id']."\">" . $row['exer_name'] . "</option>\n";
					}
				}
            ?>
        </select>
    </div>
    <input type="submit" hidden="hidden">
    </form>

    

		<h3 class="sub-header">List of Question</h3>
		<button type="button" class="btn btn-success" data-toggle="modal" data-target="#BtnAddNewQuestion">
			Add New Question
		</button>
	          <div class="table-responsive">
	            <table class="table table-hover">
	              <thead>
	                <tr>
	                  <th>#</th>
	                  <th>Question</th>
	                  <th>Answer</th>
	                  <th>Menu</th>
	                </tr>
	              </thead>
	              <tbody>
	              <?php
		              	$sql = "SELECT * FROM questionaire";
		              	$user_count = "";
						$result = mysqli_query( $link, $sql );
						while( $row = @mysqli_fetch_assoc( $result ) ) {
							$user_count++;
								echo "<tr>\n";
								echo "	<td>" . $user_count . "</td>\n";
								echo "	<td>" . $row['question'] . "</td>\n";
								echo "	<td>" . $row['answer'] . "</td>\n";
								echo "	<td><a href=\"#\" class=\"glyphicon glyphicon-edit\"></a>&nbsp;<a href=\"#\" class=\"glyphicon glyphicon-remove\"></a></td>\n";
								echo "</tr>\n";
						}
	              ?>
	              </tbody>
	            </table>
	            <h4>Total Question: <?php echo $user_count; ?></h4>
	          </div>