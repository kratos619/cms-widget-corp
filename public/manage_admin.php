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
<?php include("../include/layouts/header.php"); ?>
<?php find_selected_page();?>
<div id="main">
<div id="navigation">
<br>
<a href="admin.php">&laquo; Main Menu</a> <br>
		<?php
		//function navigation to display function
		echo navigation($current_subject,$current_page); ?>
<br/>
<a href="new_subject.php"> + Add Subject</a>
	</div>
<div id="page">
<?php $admin_set = find_all_admins(); ?>
<table>
  <tr>
    <th>User Name</th>
    <th>Action</th>

  </tr>
  <?php while ($admin = mysqli_fetch_assoc($admin_set)) {
  ?>
  <tr>

    <td> <?php echo htmlentities($admin["username"]); ?></td>
    <td> <a href="edit_admin.php?id=<?php echo htmlentities($admin["id"]); ?>">Edit</a> <a href="delete_admin.php?id=<?php echo htmlentities($admin["id"]); ?>">Delete</a> </td>

  </tr>
<?php } ?>
</table>
<br>
<a href="new_admin.php"> Add New Admin</a>
<br>
<br>

</div>
</div>
<?php include("../include/layouts/footer.php"); ?>
