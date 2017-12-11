<?php
// include once tym adding db-connection
require_once("../include/db_connection.php"); ?>
<?php
// include once tym
require_once("../include/functions.php"); ?>
<?php include("../include/layouts/header.php"); ?>

<?php
$selected_page_id  = null;
$selected_subject_id  = null;
if(isset($_GET["subject"])){
	$selected_subject_id = $_GET["subject"];
}elseif(isset($_GET["page"])){
	$selected_page_id = $_GET["page"];
}
 ?>
<div id="main">
	<div id="navigation">
		<?php
		//function navigation to display function
		echo navigation($selected_subject_id,$selected_page_id); ?>
	</div>
	<div id="page">
		<h2>Manage Content</h2>
		<?php if($selected_subject_id){ ?>
			<?php $current_subject = find_subject_by_id($selected_subject_id); ?>
		Menu Name : <?php echo $current_subject["menu_name"]; ?><br/>
	<?php } elseif ($selected_page_id) { ?>
		<?php $current_page = find_page_by_id($selected_page_id); ?>
		Page : <?php echo $current_page["menu_name"]; ?>

	<?php }else { ?>
		<h3>plsese select subject OR page</h3>
	<?php } ?>
	</div>
</div>
<?php include("../include/layouts/footer.php"); ?>
