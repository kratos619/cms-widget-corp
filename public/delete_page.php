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
$current_page = find_page_by_id($_GET["page"]);
 if(!$current_page){
// page ID was missing or incvalid
  redirect_to("manage_content.php");
}

$id = $current_page["id"];
$query = "delete from pages where id = {$id} limit 1";
$result = mysqli_query($connection, $query);
// test if there was a error
if($result && mysqli_affected_rows($connection) == 1){
  $_SESSION["message"] = "Page deleted";
    redirect_to("manage_content.php");
}else{
  $_SESSION["message"] = "Page deletion failed";
    redirect_to("manage_content.php?page={$id}");
}
?>
