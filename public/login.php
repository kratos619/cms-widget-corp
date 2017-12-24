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

<h2>Login Admin</h2>
<form action="login.php" method="post">
  <p>Username:
  <input type="text" name="username" value="">
  </p>
  <p>Password:
  <input type="password" name="hashed_password" value="">
  </p>
	<input type="submit" name="submit" value="log in" />
</form>
<br>
	</div>
</div>

<?php
if(isset($_POST['submit'])){

    // validation functions
  $required_fields = array( "username", "hashed_password");
  validate_presences($required_fields);

  if(empty($errors)){

	$username = $_POST["username"];
	$password = $_POST["hashed_password"];

$found_admin = attempt_login($username,$password);

  if($found_admin){
		$_SESSION["admin_id"]  = $found_admin["id"];
		$_SESSION["username"]  = $found_admin["username"];
      redirect_to("admin.php");
  }else{
    //failure
    $_SESSION["message"] = "Username/ Password not found";

  }
}
}
else{
  //
}
 ?>

<?php include("../include/layouts/footer.php"); ?>
