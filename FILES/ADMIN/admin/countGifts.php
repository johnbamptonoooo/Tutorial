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

			$get_users = mysql_query("SELECT SUM(paidGold) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%i') = ".$i." 
									AND DATE_FORMAT(timestamp, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d') 
									AND DATE_FORMAT(timestamp, '%H') =
									DATE_FORMAT ((NOW() + INTERVAL -1 HOUR), '%H')");

			$get_users2 = mysql_fetch_assoc($get_users);
				 
			$users_array[] = $get_users2['cnt'];
 
		}
		for ($i = 0; $i <60 ; $i++)  
		{ 

		 	$get_users = mysql_query("SELECT SUM(paidChips) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%i') = ".$i." 
									AND DATE_FORMAT(timestamp, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d') 
									AND DATE_FORMAT(timestamp, '%H') =
									DATE_FORMAT ((NOW() + INTERVAL -1 HOUR), '%H')"); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];
 
		}

		for ($i = 0; $i < 60 ; $i++) 
		{ 

		 	$get_users = mysql_query("SELECT SUM(itemsBought) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%i') = ".$i." 
									AND DATE_FORMAT(timestamp, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d') 
									AND DATE_FORMAT(timestamp, '%H') =
									DATE_FORMAT ((NOW() + INTERVAL -1 HOUR), '%H')"); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];

		}

	}

	else if ($period=='2') {// period == today

		for ($i = 1; $i <= 24 ; $i++) 
		{ 

			$get_users = mysql_query("SELECT SUM(paidGold) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%H') = ".$i." 
									AND DATE_FORMAT(timestamp, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d') 
									AND DATE_FORMAT(timestamp, '%H') =
									DATE_FORMAT ((NOW() + INTERVAL -1 HOUR), '%H')");

			$get_users2 = mysql_fetch_assoc($get_users);
				 
			$users_array[] = $get_users2['cnt'];
 
		}
		for ($i = 1; $i <=24 ; $i++)  
		{ 

		 	$get_users = mysql_query("SELECT SUM(paidChips) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%H') = ".$i." 
									AND DATE_FORMAT(timestamp, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d') 
									AND DATE_FORMAT(timestamp, '%H') =
									DATE_FORMAT ((NOW() + INTERVAL -1 HOUR), '%H')"); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];
 
		}

		for ($i = 1; $i <= 24 ; $i++) 
		{ 

		 	$get_users = mysql_query("SELECT SUM(itemsBought) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%H') = ".$i." 
									AND DATE_FORMAT(timestamp, '%Y-%m-%d') = DATE_FORMAT(CURDATE(), '%Y-%m-%d') 
									AND DATE_FORMAT(timestamp, '%H') =
									DATE_FORMAT ((NOW() + INTERVAL -1 HOUR), '%H')"); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];

		}
		
	} 
 
	else if ($period == '3'){// period == last week

		for ($i = 1; $i <= 7 ; $i++) 
		{ 

			$get_users = mysql_query("SELECT SUM(paidGold) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%Y-%m-%d') = DATE_FORMAT((NOW() + INTERVAL -".$i." DAY),'%Y-%m-%d')
									");

			$get_users2 = mysql_fetch_assoc($get_users);
				 
			$users_array[] = $get_users2['cnt'];
 
		}
		for ($i = 1; $i <= 7 ; $i++)  
		{ 
  
		 	$get_users = mysql_query("SELECT SUM(paidChips) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%Y-%m-%d') = DATE_FORMAT((NOW() + INTERVAL -".$i." DAY),'%Y-%m-%d')"); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];
 
		}
 
		for ($i = 1; $i <= 7 ; $i++) 
		{  

		 	$get_users = mysql_query("SELECT SUM(itemsBought) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%Y-%m-%d') = DATE_FORMAT((NOW() + INTERVAL -".$i." DAY),'%Y-%m-%d')"); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];

		}

	}
	else if ($period == '4'){//period == this month

		for ($i = 1; $i <= 31 ; $i++) 
		{ 

			$get_users = mysql_query("SELECT SUM(paidGold) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') AND  DATE_FORMAT(timestamp, '%d') =  ".$i.") 
									");

			$get_users2 = mysql_fetch_assoc($get_users);
				 
			$users_array[] = $get_users2['cnt'];
 
		}  
		for ($i = 1; $i <=31 ; $i++)  
		{  
  
		 	$get_users = mysql_query("SELECT SUM(paidChips) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') AND  DATE_FORMAT(timestamp, '%d') =  ".$i." "); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];
 
		}
 
		for ($i = 1; $i <= 31 ; $i++) 
		{  

		 	$get_users = mysql_query("SELECT SUM(itemsBought) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m') AND  DATE_FORMAT(timestamp, '%d') = ".$i." "); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];

		}
		
	}
	else{ //period == this year

		for ($i = 1; $i <= 12 ; $i++) 
		{ 

			$get_users = mysql_query("SELECT SUM(paidGold) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%m') = ".$i." AND DATE_FORMAT(timestamp, '%Y') = DATE_FORMAT(CURDATE(), '%Y') ;");

			$get_users2 = mysql_fetch_assoc($get_users);
				
			$users_array[] = $get_users2['cnt'];

		}
		 
		for ($i = 1; $i <= 12 ; $i++) 
		{ 

		 	$get_users = mysql_query("SELECT SUM(paidChips) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%m') = ".$i." AND DATE_FORMAT(timestamp, '%Y') = DATE_FORMAT(CURDATE(), '%Y') ;"); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];

		}

		for ($i = 1; $i <= 12 ; $i++) 
		{ 

		 	$get_users = mysql_query("SELECT SUM(itemsBought) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%m') = ".$i." AND DATE_FORMAT(timestamp, '%Y') = DATE_FORMAT(CURDATE(), '%Y') ;"); 

			$get_users2 = mysql_fetch_assoc($get_users);

			$users_array[] = $get_users2['cnt'];

		}

	}
}

else {

for ($i = 1; $i <= 12 ; $i++) 
{ 

	$get_users = mysql_query("SELECT SUM(paidGold) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%m') = ".$i." AND DATE_FORMAT(timestamp, '%Y') = DATE_FORMAT(CURDATE(), '%Y') ;");

	$get_users2 = mysql_fetch_assoc($get_users);
		
	$users_array[] = $get_users2['cnt'];

}
 
for ($i = 1; $i <= 12 ; $i++) 
{ 

 	$get_users = mysql_query("SELECT SUM(paidChips) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%m') = ".$i." AND DATE_FORMAT(timestamp, '%Y') = DATE_FORMAT(CURDATE(), '%Y') ;"); 

	$get_users2 = mysql_fetch_assoc($get_users);

	$users_array[] = $get_users2['cnt'];

}

for ($i = 1; $i <= 12 ; $i++) 
{ 

 	$get_users = mysql_query("SELECT SUM(itemsBought) AS cnt FROM gift_trans WHERE DATE_FORMAT(timestamp, '%m') = ".$i." AND DATE_FORMAT(timestamp, '%Y') = DATE_FORMAT(CURDATE(), '%Y') ;"); 

	$get_users2 = mysql_fetch_assoc($get_users);

	$users_array[] = $get_users2['cnt'];

}
}

mysql_query("COMMIT;"); 

//echo count($users_array);
 
echo json_encode($users_array);

?>