<?php 

session_start();
require_once('connections/db_connection.php');

error_reporting(E_ALL);

if (isset($_POST['status']) && isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['nickname'])
	&& isset($_POST['password']) && isset($_POST['location']) && isset($_POST['email']))
{	
	$active_user = mysql_real_escape_string(trim($_SESSION["username"]));
	$status = mysql_real_escape_string(trim($_POST['status']));
	$name = mysql_real_escape_string(trim($_POST['name']));
	$surname = mysql_real_escape_string(trim($_POST['surname']));
	$nickname = mysql_real_escape_string(trim($_POST['nickname']));
	$password = mysql_real_escape_string(trim($_POST['password']));
	$location = mysql_real_escape_string(trim($_POST['location']));
	$email = mysql_real_escape_string(trim($_POST['email']));
	$avatar_path = mysql_real_escape_string(trim($_FILES["avatar_path"]["name"]));
	
	mysql_select_db($database, $connect);
	mysql_query("SET NAMES 'utf8'");

	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");
	
	$count_users = false;
	$update_user = false;

	// check if username exists
	$get_mail = mysql_query("SELECT email FROM users WHERE email='".$email."' AND email!='".$active_user."';");
	$count_users = mysql_num_rows($get_mail);
	//username exists - no update
	if ($count_users > 0)
	{
		//commit transaction
		mysql_query("COMMIT;");
		
		$_SESSION['username_exists'] = "Username exists!";

		$host=$_SERVER["HTTP_HOST"];
		$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: http://$host$path/myProfile.php");
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
					
					$get_image = mysql_query("SELECT avatar FROM users WHERE email='".$active_user."';");
					$get_image2 = mysql_fetch_assoc($get_image);
					
					$image = $get_image2['avatar'];
					
					//delete images					
					if ($image != '')
					{
						if (file_exists("../velvetpoker/assets/users/".$image))
						{
						   unlink("../velvetpoker/assets/users/".$image);
						}
					}				
					
					$update_user = mysql_query("UPDATE users SET status=".$status.", name='".$name."', surname='".$surname."', password='".$password."', location='".$location."', email='".$email."',
						           avatar='".$path."' WHERE email='".$active_user."';");

					$_SESSION["username"] = $email;
					
				}
			}
			else
			{
				echo "Invalid file";
			}
		}
		else
		{
			$update_user = mysql_query("UPDATE users SET status=".$status.", name='".$name."', surname='".$surname."',
				            password='".$password."', location='".$location."', email='".$email."'
				           WHERE email='".$active_user."';");

			$_SESSION["username"] = $email;	
		}				
		
		if ($update_user)
		{
			//commit transaction
			mysql_query("COMMIT;");
			
			$host=$_SERVER["HTTP_HOST"];
			$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
			header("Location: http://$host$path/myProfile.php");
			exit;
		}
		else
		{
			//commit transaction
			mysql_query("COMMIT;");
			
			$_SESSION['update_user'] = "Update failed!";
			
			$host=$_SERVER["HTTP_HOST"];
			$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
			header("Location: http://$host$path/myProfile.php");
			exit;
		}
	}
}
else
{	
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/myProfile.php");
	exit;
}

?>