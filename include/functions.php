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

 ?>
