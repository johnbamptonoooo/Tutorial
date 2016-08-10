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

if (isset($_POST['status']) && isset($_POST['name']) && isset($_POST['quantity']) && isset($_POST['price']) &&
	isset($_POST['description']) && isset($_POST['type']) && isset($_POST['product_id']) && isset($_POST['product_type']))
{
	$status = mysql_real_escape_string(trim($_POST['status']));
	$name = mysql_real_escape_string(trim($_POST['name']));
	$quantity = mysql_real_escape_string(trim($_POST['quantity']));
	$price = mysql_real_escape_string(trim($_POST['price']));	
	$description = mysql_real_escape_string($_POST['description']);
	$type = mysql_real_escape_string(trim($_POST['type']));
	$product_id = mysql_real_escape_string(trim($_POST['product_id']));
	$product_type = mysql_real_escape_string(trim($_POST['product_type']));
	
	mysql_select_db($database, $connect);
	mysql_query("SET NAMES 'utf8'");
	
	$insert_product = false;
	
	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");
				
	$insert_product = mysql_query("INSERT INTO products (status, name, quantity, price, description, type, productId, product_type)
		              VALUES (".$status.", '".$name."', ".$quantity.", ".$price.", '".$description."', ".$type.", '".$product_id."',
					  ".$product_type.");");				
			
	
	//commit transaction
	mysql_query("COMMIT;");
	
	if ($insert_product)
	{
		$host=$_SERVER["HTTP_HOST"];
		$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: http://$host$path/products.php");
		exit;
	}
	else
	{
		$_SESSION['insert_product'] = "Insert failed!";
		
		$host=$_SERVER["HTTP_HOST"];
		$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
		header("Location: http://$host$path/newProduct.php");
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