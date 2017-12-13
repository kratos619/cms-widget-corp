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

<?php
if(isset($_POST['submit'])){

  if(empty($errors)){
// perform update

$id = $current_subject["id"];
  $menu_name = mysql_prep( $_POST["menu_name"]);
  $position = (int) $_POST["position"];
  $visible = (int) $_POST["visible"];

  // 2. perform quey
  $query = "update subjects SET ";
  $query .= " menu_name = '{$menu_name}', ";
  $query .= "position = '{$position}', ";
   $query .= "visible = '{$visible}'";
  $query .= " where id = {$id} ";
  $query .= "limit 1";
  $result = mysqli_query($connection, $query);
  // test if there was a error
  if($result && mysqli_affected_rows($connection) == 1){
    $_SESSION["message"] = "Subject Updated";
      redirect_to("manage_content.php");
  }else{
    //failure
    $message = "Subject Updated failed";
  }
}
}else{

}//end if(isset($_POST['submit'])){

 ?>


<?php
// include validation function file
require_once("../include/validation_functions.php"); ?>
<?php include("../include/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		<?php
		//function navigation to display function
		echo navigation($selected_subject_id,$selected_page_id); ?>
	</div>
	<div id="page">
<?php
// displaying successfull or not message just use variable not session
if(!empty($message)){
  echo "<div class=\"message\">" . $message . "</div>";
}
	?>
	<?php
// displayig error messe
	$errors =  errors();
	echo from_errors($errors);
	?>

<h2>Edit Subject: <?php echo $current_subject["menu_name"]; ?> </h2>
<form action="edit_subject.php?subject=<?php echo $current_subject["id"]; ?>" method="post">
  <p>Edit Name:
  <input type="text" name="menu_name" value="<?php echo  $current_subject["menu_name"]; ?>">
  </p>
  <p>
		Position:
		<select class="" name="position">
			<?php
			$subject_set = find_all_subjects();
			// mysqli_num_rows retun number of rows
			$subject_count = mysqli_num_rows($subject_set);
				for ($count=1; $count <= ($subject_count + 1); $count++) {
					echo "<option value=\"{$count}\"";
            if($current_subject["position"] == $count){
                  echo " selected";
            }
          echo ">{$count}</option>";
				}
			 ?>

		</select>
	</p>
  <p>visible:
    <input type="radio" name="visible" value="0" <?php if($current_subject["visible"] == 0){ echo "checked"; } ?> > No &nbsp;
    <input type="radio" name="visible" value="1"  <?php if($current_subject["visible"] == 1){ echo "checked"; } ?> > Yes
  </p>
  <input type="submit" name="submit" value="Edit Subject" />
</form>
<br>
<a href="manage_content.php"> Cancle </a>
<a onclick="return confirm('are you sure');" href="delete_subject.php?subject=<?php echo $current_subject["id"]; ?>"> Delete Subject</a>
	</div>
</div>
<?php include("../include/layouts/footer.php"); ?>
