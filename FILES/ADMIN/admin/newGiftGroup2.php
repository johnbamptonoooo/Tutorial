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

if (isset($_POST['name']))
{
	$name = mysql_real_escape_string(trim($_POST['name']));
	
	mysql_select_db($database, $connect);
	mysql_query("SET NAMES 'utf8'");
	
	$insert_group = false;

	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");
				
	$insert_group = mysql_query("INSERT INTO gift_groups (name) VALUES ('".$name."');");

	//commit transaction
	mysql_query("COMMIT;");				
			
	
	if ($insert_group)
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