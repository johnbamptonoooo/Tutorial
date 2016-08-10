<?php

require_once('connections/db_connection.php');

mysql_select_db($database, $connect);
mysql_query("SET NAMES 'utf8'");
	
	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");

	?>

		<table class="table center">
				<thead>
					<tr>
						<th>Type</th>
						<th class="small10">Quantity</th>
						<th class="small10">In gold</th>
						<th class="small10">In chips</th>
					</tr>
				</thead>
				<tbody>

				<?php
 
				$get_counts = mysql_query("SELECT id, name FROM gift_groups;");

				$inGold_tot=0;
				$inChips_tot=0;
				$gift_quantity=0;

				while ($get_counts2 = mysql_fetch_assoc($get_counts))

				{ 

				?>
					<tr>

						<td><?php 

							echo $get_counts2['name'];

						?></td>
						<td class="small10"><?php 

							$groupId = $get_counts2['id'];
												
							$get_cnt = mysql_query("SELECT COUNT(gt.transId) AS count, g.gift_group AS gift_group, g.id AS gift_id, gt.itemsBought AS quantity, gt.paidChips AS inChips, gt.paidGold AS inGold, gt.giftId AS gift_id_bought 
								FROM gifts g, gift_trans gt 
								WHERE g.id = gt.giftId AND g.gift_group = ".$groupId.";"); 

							//$get_cnt2 = mysql_fetch_assoc($get_cnt);

							$inGold=0;
							$inChips=0; 
							$br=0;

							while ($get_cnt2 = mysql_fetch_assoc($get_cnt)) {
							 	
								$inGold = $inGold + $get_cnt2['inGold'];

								$inChips = $inChips + $get_cnt2['inChips'];

								$gift_quantity = $gift_quantity + $get_cnt2['count']*$get_cnt2['quantity'] ;

								if ($br==0){

									echo $get_cnt2['count']; 

								}

								$br++;

							 } 
 
							//echo "ok";

						?></td>

						<td class="small10"><?php 

							 echo $inGold; 

						?></td>

						<td class="small10"><?php 

							 echo $inChips; 

						?></td>

					</tr>

				<?php	

				$inGold_tot=$inGold_tot + $inGold;
				$inChips_tot=$inChips_tot + $inChips;

				} 							

			?>

			</tbody>
		</table>

		<br>

	<table class="table">
		<thead>
			<tr>
				<th class="center">Quantity</th><th class="small10">In gold</th><th class="small10">In chips</th>
			</tr>
		</thead>
		<tbody> 
			<tr>
				<td class="center"><?php echo $gift_quantity; ?></td><td class="small10"><?php echo $inGold_tot; ?></td><td class="small10"><?php echo $inChips_tot; ?></td>    
			</tr>
		</tbody>
	</table>



	<?php

?>