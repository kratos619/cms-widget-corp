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
<?php
// include validation function file
require_once("../include/validation_functions.php"); ?>

<?php
if(isset($_POST['submit'])){

  $menu_name = mysql_prep( $_POST["menu_name"]);
  $position = (int) $_POST["position"];
  $visible = (int) $_POST["visible"];


    // validation functions
  $required_fields = array( "menu_name", "position");
  validate_presences($required_fields);

  $filds_with_max_length = array("menu_name" => 30 );
  validate_max_length($filds_with_max_length);

  if(!empty($errors)){
    $_SESSION["errors"] = $errors;
    redirect_to("new_subject.php");
  }

  // 2. perform quey
  $query = "insert into subjects (";
  $query .= " menu_name, position, visible";
  $query .= ") values (";
  $query .= " '{$menu_name}', '{$position}', '{$visible}'";
  $query .= ")";
  $result = mysqli_query($connection, $query);
  // test if there was a error
  if($result){
    $_SESSION["message"] = "Suject Created";
      redirect_to("manage_content.php");
  }else{
    //failure
    $_SESSION["message"] = "Suject Creation failed";
      redirect_to("new_subject.php");
  }
}
else{
  redirect_to("new_subject.php");
}

 ?>

<?php
//5. close db connection
// to check and see we connect or not for good practices
if(isset ($connection)){
	mysqli_close($connection);
}
?>
