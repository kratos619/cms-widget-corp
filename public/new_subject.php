<?php
// include once tym adding db-connection
require_once("../include/db_connection.php"); ?>
<?php
// include once tym
require_once("../include/functions.php"); ?>
<?php include("../include/layouts/header.php"); ?>
<?php find_selected_page();?>
<div id="main">
	<div id="navigation">
		<?php
		//function navigation to display function
		echo navigation($selected_subject_id,$selected_page_id); ?>
	</div>
	<div id="page">
<h2>Create Subject</h2>
<form action="create_subject.php" method="post">
  <p>Menu Name:
  <input type="text" name="menu_name" value="">
  </p>
	<p>
		Position:
		<select class="" name="position">
			<?php
			$subject_set = find_all_subjects();
			$subject_count = mysqli_num_rows($subject_set);
				for ($count=1; $count <= ($subject_count + 1) ; $count++) {
					echo '<option value="'. $count . '">' . $count . '</option>';
				}
			 ?>

		</select>
	</p>
  <p>visible:
    <input type="radio" name="visible" value="0"> No &nbsp;
    <input type="radio" name="visible" value="1"> Yes
  </p>
  <input type="submit" name="" value="Create Subject" />
</form>
<br>
<a href="manage_content.php"> Cancle</a>
	</div>
</div>
<?php include("../include/layouts/footer.php"); ?>
