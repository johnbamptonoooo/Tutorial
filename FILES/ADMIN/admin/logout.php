<?php 

session_start();

//destroy session variables
unset($_SESSION['username']);
unset($_SESSION['admin']);
session_destroy();

//redirect to login page
$host=$_SERVER["HTTP_HOST"];
$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
header("Location: http://$host$path/index.php");
exit;

?>