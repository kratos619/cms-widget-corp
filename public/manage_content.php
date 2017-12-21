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
<br>
<a href="admin.php">&laquo; Main Menu</a> <br>
		<?php
		//function navigation to display function
		echo navigation($current_subject,$current_page); ?>
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
		Menu Name : <?php echo htmlentities($current_subject["menu_name"]); ?><br/>
		Position : <?php echo htmlentities($current_subject["position"]); ?><br/>
		Visible : <?php echo htmlentities($current_subject["visible"] == 1 ? 'Yes' : 'No'); ?> <br>
		<a href="edit_subject.php?subject=<?php echo urlencode($current_subject["id"]); ?>">Edit Subject</a><br>

<br>
<h2>Pages In the Subjects</h2>
<ul>
	<?php
	$subject_pages = find_pages_for_subjects($current_subject["id"]);
	while($page = mysqli_fetch_assoc($subject_pages)){
		echo "<li>";
		$safe_page_id = urlencode($page["id"]);
		echo "<a href=\"manage_content.php?page={$safe_page_id}\">";
		echo htmlentities($page["menu_name"]);
		echo "</a>";
		echo "</li>";
	}

	  ?>

</ul>
<br>
	<a href="new_page.php?subject=<?php echo urlencode($current_subject["id"]);?>">+ Add New Page to This Subject</a>
	<?php } elseif ($current_page) { ?>
		<h2>Manage Page</h2>
		Page : <?php echo htmlentities($current_page["menu_name"]); ?>
		Position : <?php echo htmlentities($current_page["position"]); ?><br/>
		Visible : <?php echo htmlentities($current_page["visible"] == 1 ? 'Yes' : 'No'); ?> <br>
		Content: <br>
		<div class="view-content">
			 <?php echo htmlentities($current_page["content"]); ?><br/>
		</div>
		<br>
		<br>
		<a href="edit_page.php?page=<?php urlencode($current_page['id']);?>">Edit Page</a>
	<?php }else { ?>
		<h3>plsese select subject OR page</h3>
	<?php } ?>
	</div>
</div>
<?php include("../include/layouts/footer.php"); ?>
