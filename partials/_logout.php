<?php 
session_start();

// Checking if the user is an admin before unsetting and destroying the session
$is_admin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;

session_unset();
session_destroy();

if($is_admin){
  header("Location: ../admin/admin_login.php");
} else {
  header("Location: ../user/user_login.php");
}

exit();
?>
