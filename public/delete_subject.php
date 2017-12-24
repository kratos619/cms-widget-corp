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
<?php find_selected_page();?>

<?php
$current_subject = find_subject_by_id($_GET["subject"]);
 if(!$current_subject){
  redirect_to("manage_content.php");
}
$page_set = find_pages_for_subjects($current_subject["id"]);
if(mysqli_num_rows($page_set) > 0){
    $_SESSION["message"] = "cant delete a subjects with pages";
      redirect_to("manage_content.php?subject={$current_subject["id"]}");

}
$id = $current_subject["id"];
$query = "delete from subjects where id = {$id} limit 1";
$result = mysqli_query($connection, $query);
// test if there was a error
if($result && mysqli_affected_rows($connection) == 1){
  $_SESSION["message"] = "Subject deleted";
    redirect_to("manage_content.php");
}else{
  $_SESSION["message"] = "Suject deletion failed";
    redirect_to("new_subject.php?subject={$id}");
}

?>
