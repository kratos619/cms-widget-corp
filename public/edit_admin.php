<?php require_once("../include/session.php"); ?>
<?php
// include once tym adding db-connection
require_once("../include/db_connection.php"); ?>
<?php
// include once tym
require_once("../include/functions.php"); ?>

<?php
 confirm_logged_in();
 ?>

<?php $layout_context = "admin"; ?>
<?php
// include validation function file
require_once("../include/validation_functions.php"); ?>

<?php include("../include/layouts/header.php"); ?>
<?php find_selected_page();?>
<div id="main">
	<div id="navigation">

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

<?php $admin = find_admin_by_id("id") ?>

<h2>Create Admin</h2>
<form action="edit_admin.php?id=<?php echo $admin["id"]; ?>" method="post">
  <p>Username:
  <input type="text" name="username" value="<?php echo $admin["username"]; ?>">
  </p>
  <p>Password:
  <input type="password" name="hashed_password" placeholder="new Password" value="">
  </p>
	<input type="submit" name="submit" value="Create Admin" />
</form>
<br>
<a href="manage_content.php"> Cancle</a>
	</div>
</div>

<?php
if(isset($_POST['submit'])){

  if(empty($errors)){
// perform update

$id = $admin["id"];
  $username = mysql_prep( $_POST["username"]);
  $password = password_encrypt( $_POST["hashed_password"]);


  // 2. perform quey
  $query = "update admins SET ";
  $query .= " username = '{$username}', ";
  $query .= "hashed_password = '{$password}'";
  $query .= " where id = {$id} ";
  $query .= "limit 1";
  $result = mysqli_query($connection, $query);
  // test if there was a error
  if($result && mysqli_affected_rows($connection) >= 0){
    $_SESSION["message"] = "Admin Updated";
      redirect_to("manage_admin.php");
  }else{
    //failure
    $message = "admin Updated failed";
  }
}
}else{

}//end if(isset($_POST['submit'])){

 ?>


<?php include("../include/layouts/footer.php"); ?>
