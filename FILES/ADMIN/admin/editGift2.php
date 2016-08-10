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

if (isset($_POST['id']) && isset($_POST['status']) && isset($_POST['name']) && isset($_POST['price_gold']) &&
	isset($_POST['price_gold']) && isset($_POST['group']) && isset($_POST['description']) &&
	isset($_FILES['image_path']) && isset($_POST['gift_type']))
{
	$id = mysql_real_escape_string(trim($_POST['id']));
	$status = mysql_real_escape_string(trim($_POST['status']));
	$name = mysql_real_escape_string(trim($_POST['name']));
	$price_gold = mysql_real_escape_string(trim($_POST['price_gold']));
	$price_chips = mysql_real_escape_string(trim($_POST['price_chips']));
	$group = mysql_real_escape_string(trim($_POST['group']));	
	$description = mysql_real_escape_string($_POST['description']);
	$image_path = mysql_real_escape_string(trim($_FILES["image_path"]["name"]));
	$gift_type = mysql_real_escape_string(trim($_POST['gift_type'])); 
	
	mysql_select_db($database, $connect);
	mysql_query("SET NAMES 'utf8'");

	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");
	
	$update_gift = false;

	//check if file exists
	if ($_FILES["image_path"]["name"] != '')
	{		
		//upload photo
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$extension = end(explode(".", $_FILES["image_path"]["name"]));
		
		if ((($_FILES["image_path"]["type"] == "image/gif")
			|| ($_FILES["image_path"]["type"] == "image/jpeg")
			|| ($_FILES["image_path"]["type"] == "image/jpg")
			|| ($_FILES["image_path"]["type"] == "image/pjpeg")
			|| ($_FILES["image_path"]["type"] == "image/x-png")
			|| ($_FILES["image_path"]["type"] == "image/png"))
			&& ($_FILES["image_path"]["size"] < 2000000)
			&& in_array($extension, $allowedExts))
		{
			if ($_FILES["image_path"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["image_path"]["error"] . "<br>";
			}
			else
			{					
				//set file name
				$path = $_FILES["image_path"]["name"];
				$temp = $path;
				
				$counter = 1;
				
				if (file_exists("../velvetpoker/assets/gifts/".$_FILES["image_path"]["name"]))
				{
					while (file_exists("../velvetpoker/assets/gifts/".$temp))
					{
						$temp = $counter.$_FILES["image_path"]["name"];					
						$counter++;
					}
					$path = $temp;					
				}				
				
				move_uploaded_file($_FILES["image_path"]["tmp_name"], "../velvetpoker/assets/gifts/".$path);								
				
				$get_image = mysql_query(sprintf("SELECT imagePath FROM gifts WHERE id=%d;", mysql_real_escape_string(trim($id))));
				$get_image2 = mysql_fetch_assoc($get_image);
				
				$image = $get_image2['imagePath'];
				
				//delete images				
				if ($image != '')
				{
					if (file_exists("../velvetpoker/assets/gifts/".$image))
					{
						unlink("../velvetpoker/assets/gifts/".$image);
					}
				}			
				
				$update_gift = mysql_query("UPDATE gifts SET status=".$status.", name='".$name."', price_gold=".$price_gold.",
							   price_chips=".$price_chips.", gift_group=".$group.", description='".$description."',
							   imagePath='".$path."', existsInClient=".$gift_type." WHERE id=".$id.";");
				
				}
		}
		else
		{
			echo "Invalid file";
		}
	}
	else
	{
		$update_gift = mysql_query("UPDATE gifts SET status=".$status.", name='".$name."', price_gold=".$price_gold.",
					   price_chips=".$price_chips.", gift_group=".$group.", description='".$description."',
					   existsInClient=".$gift_type." WHERE id=".$id.";");
	}

	//commit transaction
	mysql_query("COMMIT;");			
	
	if ($update_gift)
	{
		$host=$_SERVER["HTTP_HOST"];
		$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: http://$host$path/gifts.php");
		exit;
	}
	else
	{
		$_SESSION['update_gift'] = "Update failed!";
		
		$host=$_SERVER["HTTP_HOST"];
		$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: http://$host$path/editGift.php?id=".$id);
		exit;
	}
}
else
{	
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/gifts.php");
	exit;
}

?>