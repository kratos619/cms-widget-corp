<?php require_once("../include/session.php"); ?>
<?php
// include once tym adding db-connection
require_once("../include/db_connection.php"); ?>
<?php
// include once tym
require_once("../include/functions.php"); ?>
<?php
// include validation function file
require_once("../include/validation_functions.php"); ?>
<?php find_selected_page();?>
<?php
if(!$current_page){
	redirect_to("manage_content.php");
}
 ?>
<?php
if(isset($_POST['submit'])){

$id = $current_page["id"];
		$menu_name = mysql_prep( $_POST["menu_name"]);
    $position = (int) $_POST["position"];
    $visible = (int) $_POST["visible"];
    $content = mysql_prep($_POST["content"]);
  if(empty($errors)){
// perform update
  // 2. perform quey
  $query = "update pages SET ";
  $query .= " menu_name = '{$menu_name}', ";
  $query .= "position = {$position}, ";
   $query .= "visible = {$visible}, ";
     $query .= "content = '{$content}' ";
  $query .= "where id = {$id} ";
  $query .= "limit 1";
  $result = mysqli_query($connection, $query);
  // test if there was a error
  if($result && mysqli_affected_rows($connection) == 1){
    $_SESSION["message"] = "page Updated";
      redirect_to("manage_content.php");
  }else{
    //failure
    $message = "Page Updated failed";
  }
}
}else{

}//end if(isset($_POST['submit'])){

 ?>
 <?php $layout_context = "admin"; ?>
<?php include("../include/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		<?php
		//function navigation to display function
		echo navigation($current_subject,$current_page); ?>
	</div>
	<div id="page">
	<?php
// displayig error messe
	$errors =  errors();
	echo from_errors($errors);
	?>

<h2>Edit page: <?php echo htmlentities($current_page["menu_name"]); ?> </h2>
<br>
<form action="edit_page.php?page=<?php echo urlencode($current_page["id"]); ?>" method="post">
  <p>Edit Name:
  <input type="text" name="menu_name" value="<?php echo  htmlentities($current_page["menu_name"]); ?>">
  </p>
  <p>
		Position:
		<select class="" name="position">
			<?php
			$page_set = find_pages_for_subjects($current_page["subject_id"]);
			// mysqli_num_rows retun number of rows
			$page_count = mysqli_num_rows($page_set);
				for ($count=1; $count <= $page_count  ; $count++) {
          echo "<option value=\"{$count}\"";
            if($current_page["position"] == $count){
                  echo " selected";
            }
          echo ">{$count}</option>";
				}
			 ?>

		</select>
	</p>
  <p>visible:
    <input type="radio" name="visible" value="0" <?php if($current_page["visible"] == 0){ echo "checked"; } ?> > No &nbsp;
    <input type="radio" name="visible" value="1"  <?php if($current_page["visible"] == 1){ echo "checked"; } ?> > Yes
  </p>
  <p>
    <textarea name="content" rows="8" cols="80"><?php echo htmlentities($current_page["content"]); ?></textarea>
  </p>
  <input type="submit" name="submit" value="Edit Page" />
</form>
<br>
<a href="manage_content.php"> Cancle </a>
<a onclick="return confirm('are you sure');" href="delete_page.php?page=<?php echo urlencode($current_page["id"]); ?>"> Delete Subject</a>
	</div>
</div>
<?php include("../include/layouts/footer.php"); ?>
