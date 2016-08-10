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

if (isset($_POST['status']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['username']) && $_POST['username'] != ''
	&& isset($_POST['password']) && $_POST['password'] != '' && isset($_POST['location']) && isset($_POST['email']))
{
	$status = mysql_real_escape_string(trim($_POST['status']));
	$name = mysql_real_escape_string(trim($_POST['name']));
	$surname = mysql_real_escape_string(trim($_POST['surname']));
	$username = mysql_real_escape_string(trim($_POST['username']));
	$password = mysql_real_escape_string(trim($_POST['password']));
	$location = mysql_real_escape_string(trim($_POST['location']));
	$email = mysql_real_escape_string(trim($_POST['email']));
	$avatar_path = mysql_real_escape_string(trim($_FILES["avatar_path"]["name"]));
	
	mysql_select_db($database, $connect);
	mysql_query("SET NAMES 'utf8'");

	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");

	$current_admin = mysql_real_escape_string(trim($_SESSION["admin"]));

	//check admin, display admins only if user_type=777
	$check_admin = mysql_query("SELECT user_type FROM users WHERE username='".$current_admin."';");
	$check_admin2 = mysql_fetch_assoc($check_admin);

	if ($check_admin2["user_type"] == 777)
	{	
		$count_users = false;
		$insert_admin = false;

		// check if username exists
		$get_username = mysql_query("SELECT username FROM users WHERE username='".$username."';");
		$count_users = mysql_num_rows($get_username);

		//username exists - no update
		if ($count_users > 0)
		{
			//commit transaction
			mysql_query("COMMIT;");
			
			$_SESSION['username_exists'] = "Username exists!";

			$host=$_SERVER["HTTP_HOST"];
			$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
			header("Location: http://$host$path/newAdmin.php");
			exit;
		}
		//update user
		else
		{						
			//check if file exists
			if ($_FILES["avatar_path"]["name"] != '')
			{		
				//upload photo
				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$extension = end(explode(".", $_FILES["avatar_path"]["name"]));
				
				if ((($_FILES["avatar_path"]["type"] == "image/gif")
					|| ($_FILES["avatar_path"]["type"] == "image/jpeg")
					|| ($_FILES["avatar_path"]["type"] == "image/jpg")
					|| ($_FILES["avatar_path"]["type"] == "image/pjpeg")
					|| ($_FILES["avatar_path"]["type"] == "image/x-png")
					|| ($_FILES["avatar_path"]["type"] == "image/png"))
					&& ($_FILES["avatar_path"]["size"] < 2000000)
					&& in_array($extension, $allowedExts))
				{
					if ($_FILES["avatar_path"]["error"] > 0)
					{
						echo "Return Code: " . $_FILES["avatar_path"]["error"] . "<br>";
					}
					else
					{					
						//set file name
						$path = $_FILES["avatar_path"]["name"];
						$temp = $path;
						
						$counter = 1;				
						
						if (file_exists("../velvetpoker/assets/users/".$_FILES["avatar_path"]["name"]))
						{
							while (file_exists("../velvetpoker/assets/users/".$temp))
							{
								$temp = $counter.$_FILES["avatar_path"]["name"];					
								$counter++;
							}
							$path = $temp;					
						}
						
						move_uploaded_file($_FILES["avatar_path"]["tmp_name"], "../velvetpoker/assets/users/".$path);									
						
						$insert_admin = mysql_query("INSERT INTO users (user_type, status, name, surname, username, password, location, email,
										avatar) VALUES (0, ".$status.", '".$name."', '".$surname."', '".$username."', '".$password."',
										'".$location."', '".$mail."', '".$path."');");
						
					}
				}
				else
				{
					echo "Invalid file";
				}
			}
			else
			{
				$insert_admin = mysql_query("INSERT INTO users (user_type, status, name, surname, username, password, location, email)
					            VALUES (0, ".$status.", '".$name."', '".$surname."', '".$username."', '".$password."', '".$location."',
					            '".$mail."');");
			}	
			
			if ($insert_admin)
			{
				//commit transaction
				mysql_query("COMMIT;");
				
				$host=$_SERVER["HTTP_HOST"];
				$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
				header("Location: http://$host$path/admins.php");
				exit;
			}
			else
			{
				//commit transaction
				mysql_query("COMMIT;");
				
				$_SESSION['insert_admin'] = "Insert failed!";
				
				$host=$_SERVER["HTTP_HOST"];
				$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
				header("Location: http://$host$path/newAdmin.php");
				exit;
			}
		}
	}
	else
	{	
		$host=$_SERVER["HTTP_HOST"];
		$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: http://$host$path/admins.php");
		exit;
	}
}
else
{	
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/admins.php");
	exit;
}

?>