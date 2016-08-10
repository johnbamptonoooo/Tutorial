<?php 

require_once('connections/db_connection.php');

//if admin is not logged in redirect to home page
if (!isset($_SESSION['admin']))
{
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/index.php");
	exit;
}


$username = mysql_real_escape_string(trim($_SESSION['username']));
$password = mysql_real_escape_string(trim($_SESSION['password']));

echo $username;


 ?>