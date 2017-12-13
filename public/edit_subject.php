<?php require_once("../include/session.php"); ?>
<?php
// include once tym adding db-connection
require_once("../include/db_connection.php"); ?>
<?php
// include once tym
require_once("../include/functions.php"); ?>
<?php find_selected_page();?>

<?php if(!$selected_subject_id){
  redirect_to("manage_content.php");
} ?>
<?php include("../include/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		<?php
		//function navigation to display function
		echo navigation($selected_subject_id,$selected_page_id); ?>
	</div>
	<div id="page">
<?php
// displaying successfull or not message
echo message();
	?>
	<?php
// displayig error messe
	$errors =  errors();
	echo from_errors($errors);
	?>

<h2>Edit Subject: <?php echo $current_subject["menu_name"]; ?> </h2>
<form action="edit_subject.php" method="post">
  <p>Edit Name:
  <input type="text" name="menu_name" value="<?php echo  $current_subject["menu_name"]; ?>">
  </p>
	<p>
		Position:
		<select class="" name="position" >
      <option><?php echo $current_subject["position"]; ?></option>
		</select>
	</p>
  <p>visible:
    <input type="radio" name="visible" value="0" <?php if($current_subject["visible"] == 0){ echo "checked"; } ?> > No &nbsp;
    <input type="radio" name="visible" value="1"  <?php if($current_subject["visible"] == 1){ echo "checked"; } ?> > Yes
  </p>
  <input type="submit" name="submit" value="Edit Subject" />
</form>
<br>
<a href="manage_content.php"> Cancle</a>
	</div>
</div>
<?php include("../include/layouts/footer.php"); ?>
