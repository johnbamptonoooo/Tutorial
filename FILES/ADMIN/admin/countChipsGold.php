<?php

require_once('connections/db_connection.php');

mysql_select_db($database, $connect);

mysql_query("SET NAMES 'utf8'");

//start transaction
mysql_query("SET AUTOCOMMIT=0;");

mysql_query("START TRANSACTION;");

$users_array = array();

if (isset($_POST['period'])) {

	$period  = mysql_real_escape_string(trim($_POST['period']));

	if ($period == '1') //period == last hour
	{

		for ($i = 0; $i < 60 ; $i++) 
		{ 

			$get_users = mysql_query("SELECT count(pt.transID) AS cnt, SUM(pt.price) AS money_spend FROM product_trans pt, products p 
									WHERE p.product_type = 0 
									AND pt.productId = p.id 
									AND DATE_FORMAT(pt.timestamp, '%i') = ".$i."
									AND DATE_FORMAT(pt.timestamp, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d') 
									AND DATE_FORMAT(pt.timestamp, '%H') = DATE_FORMAT ((NOW() + INTERVAL -1 HOUR), '%H')");

			$get_users2 = mysql_fetch_assoc($get_users);
				 
			$users_array[] = $get_users2['cnt'];
 
		}
		for ($i = 0; $i <60 ; $i++)  
		{ 

		 	$get_users = mysql_query("SELECT count(pt.transID) AS cnt, SUM(pt.price) AS money_spend FROM product_trans pt, products p 
									WHERE p.product_type = 1 
									AND pt.productId = p.id
									AND DATE_FORMAT(pt.timestamp, '%i') = ".$i."
									AND DATE_FORMAT(pt.timestamp, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d') 
									AND DATE_FORMAT(pt.timestamp, '%H') = DATE_FORMAT ((NOW() + INTERVAL -1 HOUR), '%H')"); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];
 
		}

		for ($i = 0; $i < 60 ; $i++) 
		{ 

		 	$get_users = mysql_query("SELECT SUM(pt.price) AS money_spend FROM product_trans pt, products p 
									WHERE pt.productId = p.id
									AND DATE_FORMAT(pt.timestamp, '%i') = ".$i."
									AND DATE_FORMAT(pt.timestamp, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d') 
									AND DATE_FORMAT(pt.timestamp, '%H') = DATE_FORMAT ((NOW() + INTERVAL -1 HOUR), '%H')"); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['money_spend'];

		}

	}

	else if ($period=='2') {// period == today

		for ($i = 1; $i <= 24 ; $i++) 
		{ 

			$get_users = mysql_query("
									SELECT count(pt.transID) AS cnt, SUM(pt.price) AS money_spend FROM product_trans pt, products p 
									WHERE p.product_type = 0 
									AND pt.productId = p.id 
									AND DATE_FORMAT(pt.timestamp, '%H') = ".$i." 
									AND DATE_FORMAT(pt.timestamp, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d')");


			$get_users2 = mysql_fetch_assoc($get_users);
				 
			$users_array[] = $get_users2['cnt'];
 
		}
		for ($i = 1; $i <=24 ; $i++)  
		{ 

		 	$get_users = mysql_query("
		 							SELECT count(pt.transID) AS cnt, SUM(pt.price) AS money_spend FROM product_trans pt, products p 
									WHERE p.product_type = 1 
									AND pt.productId = p.id
									AND DATE_FORMAT(pt.timestamp, '%H') = ".$i."
									AND DATE_FORMAT(pt.timestamp, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d')"); 
		 							

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];
 
		}

		for ($i = 1; $i <= 24 ; $i++) 
		{  

		 	$get_users = mysql_query("
		 							SELECT SUM(pt.price) AS money_spend FROM product_trans pt, products p 
									WHERE pt.productId = p.id
									AND DATE_FORMAT(pt.timestamp, '%H') = ".$i." 
									AND DATE_FORMAT(pt.timestamp, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d')");

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['money_spend'];

		}
		
	} 
 
	else if ($period == '3'){// period == last week

		for ($i = 1; $i <= 7 ; $i++) 
		{ 

			$get_users = mysql_query("

									SELECT count(pt.transID) AS cnt, SUM(pt.price) AS money_spend FROM product_trans pt, products p 
									WHERE p.product_type = 0 
									AND pt.productId = p.id 
									AND DATE_FORMAT(pt.timestamp, '%Y-%m-%d') = DATE_FORMAT((NOW() + INTERVAL -".$i." DAY),'%Y-%m-%d')
									");

			$get_users2 = mysql_fetch_assoc($get_users);
				 
			$users_array[] = $get_users2['cnt'];
 
		}
		for ($i = 1; $i <= 7 ; $i++)  
		{ 
  
		 	$get_users = mysql_query("

		 							SELECT count(pt.transID) AS cnt, SUM(pt.price) AS money_spend FROM product_trans pt, products p 
									WHERE p.product_type = 1 
									AND pt.productId = p.id
									AND DATE_FORMAT(pt.timestamp, '%Y-%m-%d') = DATE_FORMAT((NOW() + INTERVAL -".$i." DAY),'%Y-%m-%d')"); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];
 
		}
 
		for ($i = 1; $i <= 7 ; $i++) 
		{  

		 	$get_users = mysql_query("

		 				 			SELECT SUM(pt.price) AS money_spend FROM product_trans pt, products p 
									WHERE pt.productId = p.id
									AND DATE_FORMAT(pt.timestamp, '%Y-%m-%d') = DATE_FORMAT((NOW() + INTERVAL -".$i." DAY),'%Y-%m-%d')"); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['money_spend'];

		}

	}
	else if ($period == '4'){//period == this month

		for ($i = 1; $i <= 31 ; $i++) 
		{ 

			$get_users = mysql_query("
								    SELECT count(pt.transID) AS cnt, SUM(pt.price) AS money_spend FROM product_trans pt, products p 
									WHERE p.product_type = 0 
									AND pt.productId = p.id 
									AND DATE_FORMAT(pt.timestamp, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') 
								    AND  DATE_FORMAT(pt.timestamp, '%d') =  ".$i.") 
																");


			$get_users2 = mysql_fetch_assoc($get_users);
				 
			$users_array[] = $get_users2['cnt'];
 
		}  
		for ($i = 1; $i <=31 ; $i++)  
		{  
  
		 	$get_users = mysql_query("

		 							SELECT count(pt.transID) AS cnt, SUM(pt.price) AS money_spend FROM product_trans pt, products p 
									WHERE p.product_type = 1 
									AND pt.productId = p.id
									AND DATE_FORMAT(pt.timestamp, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') 
								 	AND  DATE_FORMAT(pt.timestamp, '%d') =  ".$i." ");


			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];
 
		}
 
		for ($i = 1; $i <= 31 ; $i++) 
		{  

		 	$get_users = mysql_query("

		 				 			SELECT SUM(pt.price) AS money_spend FROM product_trans pt, products p 
									WHERE pt.productId = p.id
									AND DATE_FORMAT(pt.timestamp, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') 
								 	AND  DATE_FORMAT(pt.timestamp, '%d') = ".$i." "); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['money_spend'];

		}
		
	}
	else{ //period == this year

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

		}
}

else {

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
}

mysql_query("COMMIT;"); 

//echo count($users_array);
 
echo json_encode($users_array);

?>