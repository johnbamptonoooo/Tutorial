<?php

require_once('connections/db_connection.php');

mysql_select_db($database, $connect);

mysql_query("SET NAMES 'utf8'");

//start transaction
mysql_query("SET AUTOCOMMIT=0;");

mysql_query("START TRANSACTION;");
 
$users_array = array();

for ($i = 1; $i <= 12 ; $i++) 
{ 

	$get_users = mysql_query("SELECT count(pt.transID) AS cnt, SUM(pt.price) AS money_spend FROM product_trans pt, products p 
							WHERE p.product_type = 0 AND pt.productId = p.id AND DATE_FORMAT(pt.timestamp, '%m') = ".$i." AND DATE_FORMAT(pt.timestamp, '%Y') = DATE_FORMAT(CURDATE(), '%Y') ;");

	$get_users2 = mysql_fetch_assoc($get_users);
		
	$users_array[] = $get_users2['cnt'];

}

for ($i = 1; $i <= 12 ; $i++) 
{ 

 	$get_users = mysql_query("SELECT count(pt.transID) AS cnt, SUM(pt.price) AS money_spend FROM product_trans pt, products p WHERE p.product_type = 1 AND pt.productId = p.id AND DATE_FORMAT(pt.timestamp, '%m') = ".$i." AND DATE_FORMAT(pt.timestamp, '%Y') = DATE_FORMAT(CURDATE(), '%Y');"); 

	$get_users2 = mysql_fetch_assoc($get_users);

	$users_array[] = $get_users2['cnt'];

}
for ($i = 1; $i <= 12 ; $i++) 
{  

 	$get_users = mysql_query("SELECT SUM(pt.price) AS money_spend FROM product_trans pt, products p WHERE pt.productId = p.id AND DATE_FORMAT(pt.timestamp, '%m') = ".$i." AND DATE_FORMAT(pt.timestamp, '%Y') = DATE_FORMAT(CURDATE(), '%Y');"); 

	$get_users2 = mysql_fetch_assoc($get_users);

	$users_array[] = $get_users2['money_spend'];

}

mysql_query("COMMIT;"); 

echo json_encode($users_array);

?>