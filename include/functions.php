<?php
// function to test query error
function confirm_query($result_set){
  if(!$result_set){
    die("Db query Failed.");
  }
}

//function to display all subjects
function find_all_subjects(){
global $connection;
  // 2. perform quey
  $query = "select * ";
  $query .= "from subjects ";
  $query .= "where visible = 1 ";
  $query .= "order by position ASC";
  $subject_set = mysqli_query($connection, $query);
    // test if there was a error
    // calling custome functio confirm_query
  confirm_query($subject_set);
  return $subject_set;
}

//function to display all pages
function find_pages_for_subjects($subject_id){
  global $connection;
  // 2. perform quey
  $query = "select * ";
  $query .= "from pages ";
  $query .= "where visible = 1 ";
  $query .="and subject_id = {$subject_id} ";
  $query .= "order by position ASC";
  $page_set = mysqli_query($connection, $query);
    // test if there was a error
    // calling custome functio confirm_query
  confirm_query($page_set);
  return $page_set;
}

//function navigation
//the currently selected subect id
// currently selected page id
function navigation($subject_id,$page_id){
  $output = '<ul class="subjects">';
    // print subject by creating function see function.php
    $subject_set =  find_all_subjects();
    //3. return data if any key are <integ></integ>er  mysqli_fetch_row
    // key are coloumn result are in an associative array mysqli_fetch_assoc
    // result in either or both typer of arrays mysqli_fetch_assoc
    //while($row = mysqli_fetch_row($result)){
    while($subject = mysqli_fetch_assoc($subject_set)){
        $output .= "<li";
        if($subject["id"] == $subject_id){
        $output .= " class=\"selected\"";
        }
        else{
        $output .= ">";
        }

			$output .= '<a href="manage_content.php?subject=';
			$output .= urlencode($subject["id"]);
			$output .=  '">';
				$output .= $subject["menu_name"];
			$output .='</a>';
       // function find pages belong to subjects subjects["id"] is belong to subjects table
       $page_set = find_pages_for_subjects($subject["id"]);
				$output .= '<ul class="pages">';
         while($page = mysqli_fetch_assoc($page_set)){
            $output .= "<li";
            if($page["id"] == $page_id){
            $output .= " class=\"selected\"";
            }
            else{
     $output .= ">";
            }
							$output .= '<a href="manage_content.php?page=';
							$output .= urlencode($page["id"]);
							$output .= 	'">';
								$output .= $page["menu_name"];
							$output .= '</a>';
							$output .= '</li>';
      }
							 mysqli_free_result($page_set);
				$output .= '</ul>';
				$output .= '</li>';

    }
          // 4 reslese retun data
     mysqli_free_result($subject_set);
$output .= '</ul>';
return $output;
}

?>
