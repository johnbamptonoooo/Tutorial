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

mysql_select_db($database, $connect);

$reset_avatars = false;

//start transaction
mysql_query("SET AUTOCOMMIT=0;");
mysql_query("START TRANSACTION;");

$reset_avatars = mysql_query("UPDATE users SET show_avatar=0 WHERE avatar!='';");

//commit transaction
mysql_query("COMMIT;");

if ($reset_avatars)
{
	if (isset($_POST['path']))
	{
		$checkbox = $_POST['path'];	
	 			
		$broj_b = count($checkbox);
		
		//start transaction
		mysql_query("SET AUTOCOMMIT=0;");
		mysql_query("START TRANSACTION;");

		for($i = 0; $i < $broj_b; $i++)
		{
			mysql_query("UPDATE users SET show_avatar=1 WHERE id=".$checkbox[$i].";");
		}

		//commit transaction
		mysql_query("COMMIT;");
	}
}

$host=$_SERVER["HTTP_HOST"];
$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
header("Location: http://$host$path/editAvatars.php");
exit;

?>