<?php
// include once tym adding db-connection
require_once("../include/db_connection.php"); ?>
<?php
// include once tym
require_once("../include/functions.php"); ?>

<?php
if(isset($_POST['submit'])){

  $menu_name =mysql_prep( $_POST["menu_name"]);
  $position = (int) $_POST["position"];
  $visible = (int) $_POST["visible"];
  // escape all string (prvent from sql enjection) work on be half of mysqli_real_escape_string()
  $menu_name = mysql_prep($menu_name);
  // 2. perform quey
  $query = "insert into subjects (";
  $query .= " menu_name, position, visible";
  $query .= ") values (";
  $query .= " '{$menu_name}', '{$position}', '{$visible}'";
  $query .= ")";
  $result = mysqli_query($connection, $query);
  // test if there was a error
  if($result){

      redirect_to("manage_content.php");
  }else{
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
