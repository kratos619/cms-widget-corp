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
			// print subject by creating function see function.php
			$subject_set =  find_all_subjects();
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
				 // function find pages belong to subjects subjects["id"] is belong to subjects table 
				 $page_set = find_pages_for_subjects($subject["id"]);
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
