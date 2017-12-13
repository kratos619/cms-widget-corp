<?php
session_start();
// display message after create subjects
function message(){
  if(isset($_SESSION["message"])){
  $output = '<div class="message">';
  $output .= htmlentities($_SESSION["message"]);
  $output .= '</div>';
  // clear message after displaying
  $_SESSION["message"] = null;
  return $output;
  }
}

function errors(){
  if(isset($_SESSION["errors"])){
    $errors = $_SESSION["errors"];
  // clear message after displaying
  $_SESSION["errors"] = null;
  return $errors;
  }
}

 ?>
