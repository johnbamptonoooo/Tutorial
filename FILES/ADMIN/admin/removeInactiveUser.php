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
	
	$update_user = false;
	
	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");

	$get_users = mysql_query("SELECT u.id AS id, u.name AS name, u.surname AS surname, st.name AS status, u.location AS location,
           					  u.nickname AS nickname, u.avatar AS avatar FROM users u, status_table st
           					  WHERE u.status=st.id AND u.status!=9 AND u.user_type=1 AND (NOW() + INTERVAL -100 DAY) > lastLogin;");

	while ($get_users2=mysql_fetch_assoc($get_users)) 
	{

		$id=$get_users2["id"];

		$update_user = mysql_query("UPDATE users SET status=9
                       WHERE id=".$id.";"); 

	}

	
	
	                
	//commit transaction
	mysql_query("COMMIT;");
	
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/giftGroups.php");
	exit;	

?>