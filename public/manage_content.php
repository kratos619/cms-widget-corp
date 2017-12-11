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
		<?php
		echo $selected_subject_id;
		echo $selected_page_id;
		 ?>
	</div>
</div>
<?php include("../include/layouts/footer.php"); ?>
