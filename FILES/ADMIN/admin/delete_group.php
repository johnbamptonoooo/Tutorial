<?php 

session_start();
require_once('connections/db_connection.php');

//if admin is not logged in redirect to home page
if (!isset($_SESSION['admin']))
{
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/index.php");
	exit;
}

if (isset($_GET['id']))
{
	$id = $_GET['id'];
	
	mysql_select_db($database, $connect);
	
	$delete_group = false;
	
	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");
	
	$delete_group = mysql_query(sprintf("DELETE FROM gift_groups WHERE id=%d;",
	                mysql_real_escape_string(trim($id))));
	                
	//commit transaction
	mysql_query("COMMIT;");
	
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/giftGroups.php");
	exit;	
}

?>