<?php require_once("../include/session.php"); ?>
<?php
// include once tym adding db-connection
require_once("../include/db_connection.php"); ?>
<?php
// include once tym
require_once("../include/functions.php"); ?>
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

<h2>Create Admin</h2>
<form action="new_admin.php" method="post">
  <p>Username:
  <input type="text" name="username" value="">
  </p>
  <p>Password:
  <input type="password" name="hashed_password" value="">
  </p>
	<input type="submit" name="submit" value="Create Admin" />
</form>
<br>
<a href="manage_content.php"> Cancle</a>
	</div>
</div>

<?php
if(isset($_POST['submit'])){

  $username = mysql_prep( $_POST["username"]);

	// this function is for password encryption
  $password = password_encrypt( $_POST["hashed_password"]);

    // validation functions
  $required_fields = array( "username", "hashed_password");
  validate_presences($required_fields);

  if(!empty($errors)){
    $_SESSION["errors"] = $errors;
    redirect_to("manage_admin.php");
  }

  // 2. perform quey
  $query = "insert into admins (";
  $query .= " username, hashed_password";
  $query .= ") values (";
  $query .= " '{$username}', '{$password}' ";
  $query .= ")";
  $result = mysqli_query($connection, $query);
  // test if there was a error
  if($result){
    $_SESSION["message"] = "User Is Created";
      redirect_to("manage_admin.php");
  }else{
    //failure
    $_SESSION["message"] = "User Is Creation failed";
      redirect_to("manage_admin.php");
  }
}
else{
  //
}
 ?>

<?php include("../include/layouts/footer.php"); ?>
