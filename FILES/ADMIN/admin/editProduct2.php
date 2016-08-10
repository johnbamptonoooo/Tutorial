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

if (isset($_POST['id']) && isset($_POST['status']) && isset($_POST['name']) &&  $_POST['name'] != '' && isset($_POST['quantity'])
	&& isset($_POST['price']) && isset($_POST['description']) && isset($_POST['type']) && isset($_POST['product_id'])
	&& isset($_POST['p_type']))
{
	
	$id = mysql_real_escape_string(trim($_POST['id']));
	$status = mysql_real_escape_string(trim($_POST['status']));
	$name = mysql_real_escape_string(trim($_POST['name']));
	$quantity = mysql_real_escape_string(trim($_POST['quantity']));
	$price = mysql_real_escape_string(trim($_POST['price']));	
	$description = mysql_real_escape_string($_POST['description']);
	$type = mysql_real_escape_string(trim($_POST['type']));
	$product_id = mysql_real_escape_string(trim($_POST['product_id']));
	$product_type = mysql_real_escape_string(trim($_POST['p_type']));
	
	mysql_select_db($database, $connect);
	mysql_query("SET NAMES 'utf8'");
	
	$update_product = false;
	
	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");
				
	$update_product = mysql_query("UPDATE products SET status=".$status.", name='".$name."', quantity=".$quantity.",
								   price=".$price.", description='".$description."', type=".$type.", productId ='".$product_id."',
								   product_type=".$product_type." WHERE id=".$id.";");			
	
	//commit transaction
	mysql_query("COMMIT;");
	
	if ($update_product)
	{
		$host=$_SERVER["HTTP_HOST"];
		$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: http://$host$path/products.php");
		exit;
	}
	else
	{
		$_SESSION['update_product'] = "Update failed!";
		
		$host=$_SERVER["HTTP_HOST"];
		$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: http://$host$path/editProduct.php?id=".$id);
		exit;
	}
}
else
{	
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/products.php");
	exit;
}

?>