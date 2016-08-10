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

if (isset($_POST['id']) && isset($_POST['name']))
{
	$id = mysql_real_escape_string(trim($_POST['id']));
	$name = mysql_real_escape_string(trim($_POST['name']));
	
	mysql_select_db($database, $connect);
	mysql_query("SET NAMES 'utf8'");
	
	$update_group = false;

	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");
				
	$update_group = mysql_query("UPDATE gift_groups SET name='".$name."' WHERE id=".$id.";");

	//commit transaction
	mysql_query("COMMIT;");				 
			
	
	if ($update_group)
	{
		$host=$_SERVER["HTTP_HOST"];
		$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: http://$host$path/giftGroups.php");
		exit;
	}
	else
	{
		$_SESSION['update_group'] = "Update failed!";
		
		$host=$_SERVER["HTTP_HOST"];
		$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: http://$host$path/editGiftGroup.php?id=".$id);
		exit;
	}
}
else
{	
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/giftGroups.php");
	exit;
}

?>