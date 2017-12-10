<?php
// create db connection
$dblocalhost = "localhost";
$dbuser = "root";
$dbpassword = 1234;
$dbname = "widget_corp";
$connection = mysqli_connect($dblocalhost,$dbuser,$dbpassword,$dbname);
//test if connection succeeded
if(mysqli_connect_errno()){
  die("database connection fail: " .
  mysqli_connect_error() .
  " (" . mysqli_connect_errno() .")"
);
}
?>
<?php
// include once tym
require_once("../include/functions.php"); ?>

<?php
// 2. perform quey
$query = "select * from subjects";
$result = mysqli_query($connection, $query);
// test if there was a error
if(!$result){
  die("db connection faild");
}
?>


<?php include("../include/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		<ul>
      <?php
      //3. return data if any key are integer  mysqli_fetch_row
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
 <?php
 //5. close db connection
 mysqli_close($connection);
  ?>

<?php include("../include/layouts/footer.php"); ?>
