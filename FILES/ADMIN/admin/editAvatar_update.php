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

//$reset_avatars = mysql_query("UPDATE users SET show_avatar=0 WHERE avatar!='';");

//commit transaction
mysql_query("COMMIT;");

//if ($reset_avatars)
//{
if (isset($_POST['path']))
	{
		$checkbox = $_POST['path'];	
	 			
		$broj_b = count($checkbox);
		
		//start transaction
		mysql_query("SET AUTOCOMMIT=0;");
		mysql_query("START TRANSACTION;");

		for($i = 0; $i < $broj_b; $i++)
		{
			mysql_query("UPDATE users SET avatar='AvatarImgRemoved_320dpi.png' WHERE id=".$checkbox[$i].";");
		}

		//commit transaction
		mysql_query("COMMIT;");
	}

	if (isset($_POST['user']))
	{
		

		$checkbox1 = $_POST['user'];	
	 			
		$broj_b1 = count($checkbox1);
		

		
		//start transaction
		mysql_query("SET AUTOCOMMIT=0;");
		mysql_query("START TRANSACTION;");

		for($i = 0; $i < $broj_b1; $i++)
		{
			
			mysql_query("UPDATE users SET nickname='User1212' WHERE id=".$checkbox1[$i].";");
		}

		//commit transaction
		mysql_query("COMMIT;");
	}
//}

$host=$_SERVER["HTTP_HOST"];
$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");

header("Location: http://$host$path/editAvatar.php");

exit;

?>