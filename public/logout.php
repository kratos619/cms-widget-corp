<?php require_once("../include/session.php"); ?>
<?php
// include once tym
require_once("../include/functions.php"); ?>
<?php
//v1 : smimple Logout
// session_start();
$_SESSION["admin_id"] = null;
$_SESSION["username"] = null;
redirect_to("login.php");
 ?>

 <?php
// v2 destroy session_start
// assume nothing esle in session to keep
// session_start();
// $_SESSION = array();
//
// if(isset($_COOKIE[session_name()])){
//   setcookie(session_name(), '',time()-4200,'/');
// }
// session_distroy();
// redirect_to("login.php");
//

  ?>
