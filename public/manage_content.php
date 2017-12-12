<?php require_once("../include/session.php"); ?>
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
<br/>
<a href="new_subject.php"> + Add Subject</a>
	</div>
	<div id="page">
<h2>Welcome</h2>
<?php
echo message();
	?>
		<?php if($current_subject){ ?>
			<h2>Manage Content</h2>
		Menu Name : <?php echo $current_subject["menu_name"]; ?><br/>
	<?php } elseif ($current_page) { ?>
		<h2>Manage Page</h2>
		Page : <?php echo $current_page["menu_name"]; ?>

	<?php }else { ?>
		<h3>plsese select subject OR page</h3>
	<?php } ?>
	</div>
</div>
<?php include("../include/layouts/footer.php"); ?>
