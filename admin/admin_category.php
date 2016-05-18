<?php
	require_once "../inc/config.php";
    require_once "../inc/lib.php";

	if ( isset( $_REQUEST['inCatName'] ) && isset( $_REQUEST['inCatDesc'] ) && isset( $_REQUEST['AddNewCategory'] ) ) {
		$inCatName = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['inCatName'] ) );
		$inCatDesc = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['inCatDesc'] ) );
		$btnAddCat = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['AddNewCategory'] ) );

		admin_add_category( $inCatName, $inCatDesc );
	}

	if ( isset( $_REQUEST['cat_id'] ) && isset( $_REQUEST['inCatName'] ) && isset( $_REQUEST['inCatDesc'] ) && isset( $_REQUEST['EditCategory'] ) ) {
		$inCatId = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['cat_id'] ) );
		$inCatName = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['inCatName'] ) );
		$inCatDesc = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['inCatDesc'] ) );
		$btnAddCat = strip_tags( mysqli_real_escape_string( $link, $_REQUEST['EditCategory'] ) );

		admin_edit_category( $inCatId, $inCatName, $inCatDesc );
	}
	

?>

<h2 class="page-header">Manager</h2>

<ul class="nav nav-tabs">
  <li role="presentation"><a href="?p=exercise">Exercise</a></li>
  <li role="presentation"><a href="?p=quest">Questionaire</a></li>
  <li role="presentation" class="active"><a href="?p=category">Category</a></li>
</ul>
<br/>
<!-- Button trigger modal - Add New Category -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#BtnAddNewCategory">
	Add New Category
</button>

<h3 class="sub-header">List of Category</h3>
	          <div class="table-responsive">
	          <div class="panel panel-default">
	            <table class="table table-hover table-bordered">
	              <thead>
	                <tr>
	                  <th style="text-align: center; vertical-align: middle">#</th>
	                  <th style="vertical-align: middle">Category Name</th>
	                  <th style="vertical-align: middle">Category Description</th>
	                  <th style="text-align: center; vertical-align: middle"><div class="glyphicon glyphicon-cog"></div></th>
	                </tr>
	              </thead>
	              <tbody>
	              <?php
		              	$sql = "SELECT * FROM category";
		              	$user_count = "";
						$result = mysqli_query( $link, $sql );
						while( $row = @mysqli_fetch_assoc( $result ) ) {
							$user_count++;
							$cat_id = $row['id'];
							$cat_name = $row['category_name'];
							$cat_desc = $row['category_description'];
							echo "<tr>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">" . $user_count . "</td>\n";
							echo "	<td style=\"vertical-align: middle;\">" . $cat_name . "</td>\n";
							echo "	<td style=\"vertical-align: middle;\" title=\"".$cat_desc."\">" . shorten( $cat_desc, 35) . "</td>\n";
							echo "	<td align=\"center\" style=\"vertical-align: middle;\">";
							echo " 		<button type=\"button\" class=\"btn btn-default glyphicon glyphicon-pencil\" data-toggle=\"modal\" data-target=\"#BtnEditCategory".$cat_id."\" title=\"Edit Category\"></button>";
							//echo "		<a href=\"#\" class=\"btn btn-default glyphicon glyphicon-pencil\"></a>&nbsp;";
							echo " 		<button type=\"button\" class=\"btn btn-danger glyphicon glyphicon-trash\" data-toggle=\"modal\" data-target=\"#BtnDeleteCategory".$cat_id."\" title=\"Delete Category\"></button>";
							//echo "		<a href=\"?catid=".$cat_id."\" class=\"btn btn-danger glyphicon glyphicon-trash\"></a></td>\n";
							echo "</tr>\n";


							// Delete category prompt
							echo "<form method=\"post\" action=\"?catid=".$cat_id."\">";
							echo "<div class=\"modal fade\" id=\"BtnDeleteCategory".$cat_id."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">";
							echo "  <div class=\"modal-dialog\" role=\"document\">";
							echo "    <div class=\"modal-content\">";
							echo "      <div class=\"modal-header\">";
							echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
							echo "        <h4 class=\"modal-title\" id=\"myModalLabel\">Delete Category</h4>";
							echo "      </div>";
							echo "      <div class=\"modal-body\">";
							echo "        <div class=\"form-group\">";
							echo "			<input type=\"hidden\" name=\"cat_id\" value=\"".$cat_id."\">";
							echo "			<label>By pressing '<code>Delete Now</code>' button you will permanently remove the '".$cat_name."' category.</label>";
							echo "        </div>";
							echo "      </div>";
							echo "      <div class=\"modal-footer\">";
							echo "        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Cancel</button>";
							echo "        <button type=\"submit\" name=\"DeleteCategory\" class=\"btn btn-danger\">Delete Now</button>";
							echo "      </div>";
							echo "    </div>";
							echo "  </div>";
							echo "</div>";
							echo "</form>";

							echo "<form method=\"post\" action=\"\">";
							echo "<div class=\"modal fade\" id=\"BtnEditCategory".$cat_id."\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\">";
							echo "  <div class=\"modal-dialog\" role=\"document\">";
							echo "    <div class=\"modal-content\">";
							echo "      <div class=\"modal-header\">";
							echo "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
							echo "        <h4 class=\"modal-title\" id=\"myModalLabel\">Edit Category</h4>";
							echo "      </div>";
							echo "      <div class=\"modal-body\">";
							echo "        <div class=\"form-group\">";
							echo "			<input type=\"hidden\" name=\"cat_id\" value=\"".$cat_id."\">";
							echo "			<label for=\"inExerciseName\">Category Name:</label>";
							echo "        	<input class=\"form-control\" type=\"text\" name=\"inCatName\" id=\"inExerciseName\" placeHolder=\"Enter category name\" required=\"true\" value=\"".$cat_name."\" />";
							echo "        </div>";
							echo "        <div class=\"form-group\">";
							echo "			<label for=\"inExerciseDesc\">Category Description:</label>";
							echo "        	<input class=\"form-control\" type=\"text\" name=\"inCatDesc\" id=\"inExerciseDesc\" placeHolder=\"Enter category description\" required=\"true\" value=\"".$cat_desc."\" />";
							echo "        </div>";
							echo "      </div>";
							echo "      <div class=\"modal-footer\">";
							echo "        <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>";
							echo "        <button type=\"submit\" name=\"EditCategory\" class=\"btn btn-primary\">Save Changes</button>";
							echo "      </div>";
							echo "    </div>";
							echo "  </div>";
							echo "</div>";
							echo "</form>";


						}
	              ?>
	              </tbody>
	            </table>
	            </div>
	            <h4>Total Category: <?php echo $user_count; ?></h4>
	          </div>


<!-- Modal Add Category-->
<form method="post" action="">
<div class="modal fade" id="BtnAddNewCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add New Category</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
			<label for="inExerciseName">Category Name:</label>
        	<input class="form-control" type="text" name="inCatName" id="inExerciseName" placeHolder="Enter category name" required="true" />
        </div>
        <div class="form-group">
			<label for="inExerciseDesc">Category Description:</label>
        	<input class="form-control" type="text" name="inCatDesc" id="inExerciseDesc" placeHolder="Enter category description" required="true"/>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="AddNewCategory" class="btn btn-primary">Add New Category</button>
      </div>
    </div>
  </div>
</div>
</form>

