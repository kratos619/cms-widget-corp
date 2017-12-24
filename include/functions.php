<?php
function redirect_to($new_location){
  header("Location: ". $new_location);
  exit;
}

// work on be half of mysqli_real_escape_string()
function mysql_prep($string){
  global $connection;
  $escaped_strig = mysqli_real_escape_string($connection,$string);
return $escaped_strig;
}

// function to test query error
function confirm_query($result_set){
  if(!$result_set){
    die("Db query Failed.");
  }
}


function from_errors($errors = array()){
	$output = "";
	if(!empty($errors)){
	 $output .= "<div class=\"error\">";
	 $output .= "plese fix the following errors";
	 $output .= "<ul>";
	 foreach ($errors as $key => $error) {
		 $output .= "<li>";
     $output .= htmlentities($error);
     $output .= "</li>";
	 }
	 $output .= "</ul>";
	 $output .= "</div>";
 }
 return $output;
}

function find_all_admins(){
  global $connection;
   // 2. perform quey
   $query = "select * ";
   $query .= "from admins ";
   $query .= "order by username ASC";
   $admin_set = mysqli_query($connection, $query);
     // test if there was a error
     // calling custome functio confirm_query
   confirm_query($admin_set);
   return $admin_set;
}

function find_admin_by_id($admin_id){
  global $connection;
  // safe from sql injection
  $safe_admin_id = mysqli_real_escape_string($connection,$admin_id);
   // 2. perform quey
   $query = "select * ";
   $query .= "from admins ";
   $query .= "where id = {$safe_admin_id} ";
   // limit one select one at a time one operation at a time
   $query .= "LIMIT 1";
   $admin_set = mysqli_query($connection, $query);
     // test if there was a error
     // calling custome functio confirm_query
   confirm_query($admin_set);
   if($admin  = mysqli_fetch_assoc($admin_set)){
     return $admin;
   }else{
      return null;
   }
}

//function to display all subjects
function find_all_subjects($public = true){
 global $connection;
  // 2. perform quey
  $query = "select * ";
  $query .= "from subjects ";
  if($public){
    $query .= "where visible = 1 ";
  }
  $query .= "order by position ASC";
  $subject_set = mysqli_query($connection, $query);
    // test if there was a error
    // calling custome functio confirm_query
  confirm_query($subject_set);
  return $subject_set;
}

function find_admin_by_username($username){
  global $connection;
  // safe from sql injection
  $safe_username = mysqli_real_escape_string($connection,$username);
   // 2. perform quey
   $query = "select * ";
   $query .= "from admins ";
   $query .= "where username = '{$safe_username}' ";
   // limit one select one at a time one operation at a time
   $query .= "LIMIT 1";
   $admin_set = mysqli_query($connection, $query);
     // test if there was a error
     // calling custome functio confirm_query
   confirm_query($admin_set);
   if($admin  = mysqli_fetch_assoc($admin_set)){
     return $admin;
   }else{
      return null;
   }
}



//function to display all pages
function find_pages_for_subjects($subject_id,$public = true){
  global $connection;
  $safe_subject_id = mysqli_real_escape_string($connection,$subject_id);
  // 2. perform quey
  $query = "select * ";
  $query .= "from pages ";
  $query .="where subject_id = {$safe_subject_id} ";
  if($public){
    $query .= "and visible = 1 ";
  }
  $query .= "order by position ASC";
  $page_set = mysqli_query($connection, $query);
    // test if there was a error
    // calling custome functio confirm_query
  confirm_query($page_set);
  return $page_set;
}

function find_subject_by_id($subject_id){
  global $connection;
  // safe from sql injection
  $safe_subject_id = mysqli_real_escape_string($connection,$subject_id);
   // 2. perform quey
   $query = "select * ";
   $query .= "from subjects ";
   $query .= "where id = {$safe_subject_id} ";
   // limit one select one at a time one operation at a time
   $query .= "LIMIT 1";
   $subject_set = mysqli_query($connection, $query);
     // test if there was a error
     // calling custome functio confirm_query
   confirm_query($subject_set);
   if($subject  = mysqli_fetch_assoc($subject_set)){
     return $subject;
   }else{
      return null;
   }
}

function find_page_by_id($page_id){
  global $connection;
  // safe from sql injection
  $safe_page_id = mysqli_real_escape_string($connection,$page_id);
   // 2. perform quey
   $query = "select * ";
   $query .= "from pages ";
   $query .= "where id = {$safe_page_id} ";
   // limit one select one at a time one operation at a time
   $query .= "LIMIT 1";
   $page_set = mysqli_query($connection, $query);
     // test if there was a error
     // calling custome functio confirm_query
   confirm_query($page_set);
   if($subject  = mysqli_fetch_assoc($page_set)){
     return $subject;
   }else{
      return null;
   }

}

function find_selected_page(){
  global $current_subject;
  global $current_page;
global  $selected_page_id ;
  global $selected_subject_id;

  if(isset($_GET["subject"])){
  	$selected_subject_id = $_GET["subject"];
  	$current_subject = find_subject_by_id($selected_subject_id);
  }elseif(isset($_GET["page"])){
  	$selected_page_id = $_GET["page"];
  	$current_page = find_page_by_id($selected_page_id);
  }else{
    $selected_page_id  = null;
    $selected_subject_id  = null;
    $current_page = null;
    $current_subject = null;

  }

}
//function navigation
//the currently selected subect id
// currently selected page id
function navigation($subject_id,$page_id){
  $output = '<ul class="subjects">';
    // print subject by creating function see function.php
    $subject_set =  find_all_subjects(false);
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
				$output .= htmlentities($subject["menu_name"]);
			$output .='</a>';
       // function find pages belong to subjects subjects["id"] is belong to subjects table
       $page_set = find_pages_for_subjects($subject["id"],false);
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
								$output .= htmlentities($page["menu_name"]);
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

function public_navigation($subject_id,$page_id){
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

			$output .= '<a href="index.php?subject=';
			$output .= urlencode($subject["id"]);
			$output .=  '">';
				$output .= htmlentities($subject["menu_name"]);
			$output .='</a>';
       // function find pages belong to subjects subjects["id"] is belong to subjects table
       $page_set = find_pages_for_subjects($subject["id"],false);
				$output .= '<ul class="pages">';
         while($page = mysqli_fetch_assoc($page_set)){
            $output .= "<li";
            if($page["id"] == $page_id){
            $output .= " class=\"selected\"";
            }
            else{
     $output .= ">";
            }
							$output .= '<a href="index.php?page=';
							$output .= urlencode($page["id"]);
							$output .= 	'">';
								$output .= htmlentities($page["menu_name"]);
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

// password encrypion function

function password_encrypt($password){
  $hash_format = "$2y$10$"; // tells phph to use blowfish with "cost" of 10
$salt_length  = 22; // blowfish salts should be 22 character or moree
 $salt = generate_salt($salt_length);
 $format_and_salt = $hash_format . $salt;
 $hash = crypt($password,$format_and_salt);
 return $hash;

}

function generate_salt($length){
  // not 100% unique not 100% random but good enugh for a salts
  // md5 return 32 character
  $unique_randome_string = md5(uniqid(mt_rand(),true));

  // valid character for a salt are [a-zA-Z0-9./]
  $base64_string = base64_encode($unique_randome_string);

  // but not '+' which is valid in base64 encoding
  $modified_base64_string = str_replace('+','-',$base64_string);

  //Truncate string to the correct length
   $salt = substr($modified_base64_string, 0 , $length);

   return $salt;
}

function password_check($password,$existing_hash){
$hash = crypt($password, $existing_hash);
if($hash === $existing_hash){
  return true;
}else {
  return false;
}
}

function attempt_login($username,$password){
$admin = find_admin_by_username($username);
if($admin){
  // found admin now check password
  if(password_check($password,$admin["hashed_password"])){
    //password mathch
    return $admin;
  }else{
    // password not match
    return false;
  }
} else{
  // admin not found
  return false;
}
}

function logged_in(){
  return isset($_SESSION['admin_id']);
}

function confirm_logged_in(){
 if(!logged_in()){
   redirect_to("login.php");
 }
}

?>
