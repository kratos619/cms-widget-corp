<?php
// include once tym adding db-connection
require_once("../include/db_connection.php"); ?>

<?php
// include once tym
require_once("../include/functions.php"); ?>

<?php
// 2. perform quey
$query = "select * from subjects";
$result = mysqli_query($connection, $query);
  // test if there was a error
	// calling custome functio confirm_query
confirm_query($result);
?>


<?php include("../include/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		<ul class="subjects">
      <?php
      //3. return data if any key are <integ></integ>er  mysqli_fetch_row
      // key are coloumn result are in an associative array mysqli_fetch_assoc
      // result in either or both typer of arrays mysqli_fetch_assoc
      //while($row = mysqli_fetch_row($result)){
      while($subjects = mysqli_fetch_assoc($result)){
      ?>
      <li> <?php echo $subjects["menu_name"]; ?></li>

      <?php
      }
       ?>
    </ul>
	</div>
	<div id="page">
		<h2>Manage Content</h2>
	</div>
</div>
<?php
// 4 reslese retun data
mysqli_free_result($result);
 ?>

<?php include("../include/layouts/footer.php"); ?>
