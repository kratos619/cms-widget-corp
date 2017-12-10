<?php
// function to test query error
function confirm_query($result_set){
  if(!$result_set){
    die("Db query Failed.");
  }
}

 ?>
