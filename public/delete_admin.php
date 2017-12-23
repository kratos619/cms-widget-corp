<?php require_once("../include/session.php"); ?>
<?php
// include once tym adding db-connection
require_once("../include/db_connection.php"); ?>
<?php
// include once tym
require_once("../include/functions.php"); ?>


<?php
$current_admin = find_admin_by_id($_GET["id"]);
 if(!$current_admin){
  redirect_to("manage_admin.php");
}
$admin_set = find_all_admins();
if(mysqli_num_rows($admin_set) > 0){
    $_SESSION["message"] = "cant delete a subjects with pages";
      redirect_to("manage_admin.php?id={$admin["id"]}");

}
$id = $admin["id"];
$query = "delete from admins where id = {$id} limit 1";
$result = mysqli_query($connection, $query);
// test if there was a error
if($result && mysqli_affected_rows($connection) == 1){
  $_SESSION["message"] = "admin deleted";
    redirect_to("manage_admin.php");
}else{
  $_SESSION["message"] = "admin deletion failed";
    redirect_to("manage_admin.php");
}

?>
