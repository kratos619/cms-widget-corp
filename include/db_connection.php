<?php

//best practices to use constants
 define("DB_SERVER","localhost");
 define("DB_USER","root");
 define("DB_PASS",1234);
 define("DB_NAME","widget_corp");

// create db connection

$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
//test if connection succeeded
if(mysqli_connect_errno()){
  die("database connection fail: " .
  mysqli_connect_error() .
  " (" . mysqli_connect_errno() .")"
);
}
?>
