<?php
// include once tym adding db-connection
require_once("../include/db_connection.php"); ?>

<?php
// include once tym
require_once("../include/functions.php"); ?>
<?php include("../include/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		<ul class="subjects">
			<?php
			// 2. perform quey
			$query = "select * ";
			$query .= "from subjects ";
			$query .= "where visible = 1 ";
			$query .= "order by position ASC";
			$subject_set = mysqli_query($connection, $query);
			  // test if there was a error
				// calling custome functio confirm_query
			confirm_query($subject_set);
			?>
      <?php
      //3. return data if any key are <integ></integ>er  mysqli_fetch_row
      // key are coloumn result are in an associative array mysqli_fetch_assoc
      // result in either or both typer of arrays mysqli_fetch_assoc
      //while($row = mysqli_fetch_row($result)){
      while($subject = mysqli_fetch_assoc($subject_set)){
      ?>
      <li>
				 <?php echo $subject["menu_name"]; ?>
				 <?php
	 			// 2. perform quey
	 			$query = "select * ";
				$query .= "from pages ";
				$query .= "where visible = 1 ";
				$query .="and subject_id = {$subject["id"]} ";
				$query .= "order by position ASC";
	 			$page_set = mysqli_query($connection, $query);
	 			  // test if there was a error
	 				// calling custome functio confirm_query
	 			confirm_query($page_set);
	 			?>
				 <ul class="pages">
					 <?php
					 while($page = mysqli_fetch_assoc($page_set)){
	 	      ?>
					<li>
						<?php echo $page["menu_name"]; ?>
					</li>
					<?php
				}
					 ?>
					 <?php mysqli_free_result($page_set); ?>
				 </ul>
			</li>

      <?php
      }
       ?>
			 <?php
			 // 4 reslese retun data
			 mysqli_free_result($subject_set);
			  ?>

    </ul>
	</div>
	<div id="page">
		<h2>Manage Content</h2>
	</div>
</div>
<?php include("../include/layouts/footer.php"); ?>
