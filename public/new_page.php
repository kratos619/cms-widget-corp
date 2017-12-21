<?php require_once("../include/session.php"); ?>
<?php
// include once tym adding db-connection
require_once("../include/db_connection.php"); ?>
<?php
// include once tym
require_once("../include/functions.php"); ?>
<?php include("../include/layouts/header.php"); ?>
<?php find_selected_page();?>
<?php
if(!$current_subject){
	redirect_to("manage_content.php");
}
 ?>

 <?php
 if(isset($_POST['submit'])){

   $menu_name = mysql_prep( $_POST["menu_name"]);
   $position = (int) $_POST["position"];
   $visible = (int) $_POST["visible"];
	 $content = mysql_prep( $_POST["content"]);


     // validation functions
   $required_fields = array( "menu_name", "position","visible","content");
   validate_presences($required_fields);

   $filds_with_max_length = array("menu_name" => 30 );
   validate_max_length($filds_with_max_length);

   if(!empty($errors)){
     $_SESSION["errors"] = $errors;
     redirect_to("manage_content.php");
   }

   // 2. perform quey
   $query = "insert into pages (";
   $query .= " menu_name, position, visible";
   $query .= ") values (";
   $query .= " '{$menu_name}', '{$position}', '{$visible}'";
   $query .= ")";
   $result = mysqli_query($connection, $query);
   // test if there was a error
   if($result){
     $_SESSION["message"] = "pages Created";
       redirect_to("manage_content.php");
   }else{
     //failure
     $_SESSION["message"] = "pages Creation failed";
       redirect_to("manage_content.php");
   }
 }
 else{

 }

  ?>


<div id="main">
	<div id="navigation">
		<?php
		//function navigation to display function
		echo navigation($current_subject,$current_page);
		?>
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

<h2>Create Page</h2>
<form action="new_page.php?page=<?php echo $current_subject["id"];?>" method="post">
  <p>Page Name:
  <input type="text" name="menu_name" value="">
  </p>
	<p>
		Position:
		<select class="" name="position">
			<?php
			$page_set = find_pages_for_subjects($current_subject["id"]);
			// mysqli_num_rows retun number of rows
			$page_count = mysqli_num_rows($page_set);
				for ($count=1; $count <= ($page_count + 1) ; $count++) {
					echo '<option value="'. $count . '">' . $count . '</option>';
				}
			 ?>

		</select>
	</p>
  <p>visible:
    <input type="radio" name="visible" value="0"> No &nbsp;
    <input type="radio" name="visible" value="1"> Yes
  </p>
	<p>
		<textarea name="content" rows="8" cols="80"></textarea>
	</p>
  <input type="submit" name="" value="Create Page" />
</form>
<br>
<a href="manage_content.php"> Cancle</a>
	</div>
</div>
<?php include("../include/layouts/footer.php"); ?>
