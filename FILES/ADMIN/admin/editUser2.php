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

if (isset($_POST['id']) && isset($_POST['status']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['nickname'])
	&& $_POST['nickname'] != '' && isset($_POST['password']) && $_POST['password'] != '' && isset($_POST['location'])
	&& isset($_POST['email']) && isset($_POST['chips']) && isset($_POST['gold']))
{	
	$id = mysql_real_escape_string(trim($_POST['id']));
	$status = mysql_real_escape_string(trim($_POST['status']));
	$name = mysql_real_escape_string(trim($_POST['name']));
	$surname = mysql_real_escape_string(trim($_POST['surname']));
	$username = mysql_real_escape_string(trim($_POST['nickname']));
	$password = mysql_real_escape_string(trim($_POST['password']));
	$location = mysql_real_escape_string(trim($_POST['location']));
	$email = mysql_real_escape_string(trim($_POST['email']));
	$chips = mysql_real_escape_string(trim($_POST['chips']));
	$gold = mysql_real_escape_string(trim($_POST['gold']));
	
	mysql_select_db($database, $connect);
	mysql_query("SET NAMES 'utf8'");

	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");
	
	$count_users = false;
	$update_user = false;

	// check if username exists
	$get_username = mysql_query("SELECT nickname FROM users WHERE nickname='".$username."' AND id!=".$id.";");
	$count_users = mysql_num_rows($get_username);

	//username exists - no update
	if ($count_users > 0)
	{
		//commit transaction
		mysql_query("COMMIT;");
		
		$_SESSION['username_exists'] = "Username exists!";

		$host=$_SERVER["HTTP_HOST"];
		$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: http://$host$path/editUser.php?id=".$id);
		exit;
	}
	//update user
	else
	{						
		$update_user = mysql_query("UPDATE users SET status=".$status.", name='".$name."', surname='".$surname."', nickname='".$username."',
                       password='".$password."', location='".$location."', email='".$email."', chips=".$chips.", gold=".$gold."
                       WHERE id=".$id.";");		
		
		if ($update_user)
		{
			//commit transaction
			mysql_query("COMMIT;");
			
			$host=$_SERVER["HTTP_HOST"];
			$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
			header("Location: http://$host$path/users.php");
			exit;
		}
		else
		{
			//commit transaction
			mysql_query("COMMIT;");
			
			$_SESSION['update_user'] = "Update failed!";
			
			$host=$_SERVER["HTTP_HOST"];
			$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
			header("Location: http://$host$path/editUser.php?id=".$id);
			exit;
		}
	} 
}
else
{	
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/users.php");
	exit;
}

?>