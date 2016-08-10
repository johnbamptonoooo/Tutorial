<?php 

session_start();

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

require_once('connections/db_connection.php');

if (isset($_POST['username']) && isset($_POST['password']))
{
	$username = mysql_real_escape_string(trim($_POST['username']));
    $password = mysql_real_escape_string(trim($_POST['password']));
	
	mysql_select_db($database, $connect);

	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");
  
	$login = mysql_query("SELECT user_type, email, password FROM users WHERE email='".$username."' AND password='".$password."';");	              
   
	$check_login = mysql_num_rows($login);

	//if num rows > 0 redirect to user/admin page
	if ($check_login > 0)
	{
		$login2 = mysql_fetch_assoc($login);

		//commit transaction
		mysql_query("COMMIT;");

		//user
		if ($login2["user_type"] == 1)
		{
			//declare session variable		
			$_SESSION['username'] = $login2['email'];		
				
			$host=$_SERVER["HTTP_HOST"];
			$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
			header("Location: http://$host$path/myProfile.php");
			exit;
		}
		//admin
		else
		{
			//declare session variable		
			$_SESSION['admin'] = $login2['email'];		
				
			$host=$_SERVER["HTTP_HOST"];
			$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
			header("Location: http://$host$path/home.php");
			exit;	
		}		
	}
	else
	{
		//commit transaction
		mysql_query("COMMIT;");

		$_SESSION['login_error'] = true;
		
		$host=$_SERVER["HTTP_HOST"];
		$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: http://$host$path/index.php");
		exit;
	}	
}
else
{ 
	$_SESSION['login_error'] = true;
	
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/index.php");
	exit;
}

?>