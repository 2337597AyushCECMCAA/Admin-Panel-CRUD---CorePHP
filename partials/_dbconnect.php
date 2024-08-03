<?php 
$servername = "localhost";
$username = "root";
$password = "pass123";
$database = "shop_management";

$conn = mysqli_connect($servername,$username,$password,$database);

//check connection
if(!$conn){
  echo "Database not connected".mysqli_connect_error();
}








?>