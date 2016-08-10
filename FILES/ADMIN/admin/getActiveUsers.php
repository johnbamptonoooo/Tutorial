<?php

require_once('connections/db_connection.php');

mysql_select_db($database, $connect);
mysql_query("SET NAMES 'utf8'");
	
	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");

	mysql_query("START TRANSACTION;");

	$get_counts_today = mysql_query("SELECT COUNT(id) AS cnt FROM users WHERE DATE_FORMAT(lastLogin, '%Y-%m-%d') = CURDATE();");

	$cnt_today=mysql_fetch_assoc($get_counts_today);

	$get_counts_month = mysql_query("SELECT COUNT(id) AS cnt  FROM users WHERE DATE_FORMAT(lastLogin, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m');");

	$cnt_month=mysql_fetch_assoc($get_counts_month);

	$get_counts_week = mysql_query("SELECT COUNT(id) AS cnt FROM users WHERE lastLogin > (NOW() + INTERVAL -7 DAY);");

	$cnt_week=mysql_fetch_assoc($get_counts_week);

	$get_counts_hour = mysql_query("SELECT COUNT(id) AS cnt FROM users WHERE lastLogin > (NOW() + INTERVAL -1 HOUR);");

	$cnt_hour=mysql_fetch_assoc($get_counts_hour); 
	
	
	$get_counts_todays = mysql_query("SELECT COUNT(id) AS cnt FROM users WHERE DATE_FORMAT(dateRegistered, '%Y-%m-%d') = CURDATE();");

	$cnt_todays=mysql_fetch_assoc($get_counts_todays);

	$get_counts_months = mysql_query("SELECT COUNT(id) AS cnt  FROM users WHERE DATE_FORMAT(dateRegistered, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m');");

	$cnt_months=mysql_fetch_assoc($get_counts_months);

	$get_counts_weeks = mysql_query("SELECT COUNT(id) AS cnt FROM users WHERE dateRegistered > (NOW() + INTERVAL -7 DAY);");

	$cnt_weeks=mysql_fetch_assoc($get_counts_weeks);

	$get_counts_hours = mysql_query("SELECT COUNT(id) AS cnt FROM users WHERE dateRegistered > (NOW() + INTERVAL -1 HOUR);");

	$cnt_hours=mysql_fetch_assoc($get_counts_hours); 
	

?>
 
	<table class="table">
		<thead>
			<tr>
				<th>Active Users Interval</th>
				<th class="small10 center">Active</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Last hour</td>
				<td class="small10 center"><?php echo $cnt_hour['cnt']; ?></td>
			</tr>
			<tr>
				<td>Today</td>
				<td class="small10 center"><?php echo $cnt_today['cnt']; ?></td>
			</tr> 
			<tr>
				<td>This week</td>
				<td class="small10 center"><?php echo $cnt_week['cnt']; ?></td>
			</tr>
			<tr>
				<td>This month</td>
				<td class="small10 center"><?php echo $cnt_month['cnt']; ?></td>
			</tr>
		</tbody>
	</table>

<br> 

	<table class="table">
		<thead>
			<tr>
				<th>Registered Users in Interval</th>
				<th class="small10 center">Active</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Last hour</td>
				<td class="small10 center"><?php echo $cnt_hours['cnt']; ?></td>
			</tr>
			<tr>
				<td>Today</td>
				<td class="small10 center"><?php echo $cnt_todays['cnt']; ?></td>
			</tr> 
			<tr>
				<td>This week</td>
				<td class="small10 center"><?php echo $cnt_weeks['cnt']; ?></td>
			</tr>
			<tr>
				<td>This month</td>
				<td class="small10 center"><?php echo $cnt_months['cnt']; ?></td>
			</tr>
		</tbody>
	</table>

<br> 

	<table class="table">
		<thead>
			<tr> 
				<th>Country</th>
				<th class="small10 center">Players</th>
			</tr>
		</thead>
		<tbody>

			<?php

				$get_countries = mysql_query("SELECT DISTINCT location FROM users WHERE location != '' ORDER BY location ASC;");

				while ($get_countries2 = mysql_fetch_assoc($get_countries)) {
					?>
						<tr>
							<td><?php echo $get_countries2['location']; ?></td> 

								<td class="small10 center"><?php   

									$country=$get_countries2['location'];

									$get_ccnt = mysql_query("SELECT COUNT(id) AS cnt FROM users WHERE location LIKE '%$country%';");

									$get_ccnt2=mysql_fetch_assoc($get_ccnt); 

									echo $get_ccnt2['cnt'];  

								 ?></td>

						</tr>

					<?php

				}

			 ?>

		</tbody>
	</table>

<br> 

<?php

	mysql_query("COMMIT;"); 

?>
		

