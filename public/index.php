<?php require_once("../include/session.php"); ?>
<?php
// include once tym adding db-connection
require_once("../include/db_connection.php"); ?>
<?php
// include once tym
require_once("../include/functions.php"); ?>
<?php $layout_context = "Public"; ?>
<?php include("../include/layouts/header.php"); ?>
<?php find_selected_page();?>
<div id="main">
	<div id="navigation">
<br>
 <br>
		<?php
		//function navigation to display function
		echo public_navigation($current_subject,$current_page); ?>
		<br>
		<br>
		<a href="login.php"> + Sign Up</a>
<br/>

	</div>
	<div id="page">
		<?php if($current_subject){ ?>
			<h2>Manage Content</h2>
		Menu Name : <?php echo htmlentities($current_subject["menu_name"]); ?><br/>
<br>
<?php } elseif ($current_page) { ?>
		<h2> Page</h2>
		<div class="view-content">
			 <?php echo nl2br(htmlentities($current_page["content"])); ?><br/>
		</div>
		<br>
		<br>
	<?php }else { ?>
		<h3>Welcome</h3>
	<?php } ?>
	</div>
</div>
<?php include("../include/layouts/footer.php"); ?>
