<?php

require_once('connections/db_connection.php');

mysql_select_db($database, $connect);
mysql_query("SET NAMES 'utf8'");
	
	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");

	$get_counts = mysql_query("SELECT p.id AS id, p.name AS name, p.quantity AS chips_quantity, pt.price AS price, pt.receiptValidated AS validated
								FROM products p, product_trans pt WHERE pt.receiptValidated=1 AND pt.productId=p.id AND p.product_type=1;");

	$count=0; 
	$price_total = 0; 

	while ($get_counts2 = mysql_fetch_assoc($get_counts))

		{ 
			mysql_query("COMMIT;");
			$count++;
			$price_total = $price_total + $get_counts2['price'];

			} 
	?>
	
	<table class="table center"> 
		<thead>
			<tr>
				<th>Type</th>
				<th class="small10">Quantity</th>
				<th class="small10">Value</th>
			</tr>
		</thead>
		<tbody>
		<?php

			mysql_query("SET AUTOCOMMIT=0;");
			mysql_query("START TRANSACTION;");
				
			$get_products = mysql_query("SELECT p.id AS id, p.name AS name, st.name AS status, p.price AS price
				            FROM products p, status_table st WHERE p.status=st.id AND p.status!=9 AND p.product_type=1;");
			while ($get_products2 = mysql_fetch_assoc($get_products))
			{ ?>
			<tr>
				<td><?php echo $get_products2['name']; ?></td>
				<td><?php 

				$prod_id=$get_products2['id'];
				$get_cnt = mysql_query("SELECT COUNT(transId) AS cnt, productID FROM product_trans WHERE receiptValidated=1 AND productId=".$prod_id.";"); 
				$get_cnt2 = mysql_fetch_assoc($get_cnt);
				echo $get_cnt2['cnt']; 

				 ?></td>
				<td><?php 
				$price_total_chips=$get_cnt2['cnt']*$get_products2['price'];
				$cnt_chips=$count; 
				echo $price_total_chips." $"; ?></td>
			</tr>

		<?php
				}
				?>
			<tr>
				<td>Gold total</td>
				<td><?php echo $count; ?></td>
				<td><?php echo $price_total. " $"; ?></td>
			</tr>
		</tbody>
			</table><br>
				<table class="table center">
				<thead>
					<tr>
						<th>Type</th>
						<th class="small10">Quantity</th>
						<th class="small10">Value</th>
					</tr>
				</thead>
				<tbody>
	<?php 
	
	$get_counts = mysql_query("SELECT p.id AS id, p.name AS name, p.quantity AS chips_quantity, pt.price AS price, pt.receiptValidated AS validated
								FROM products p, product_trans pt WHERE pt.receiptValidated=1 AND pt.productId=p.id AND p.product_type=0;");

	$count=0; 
	$price_total = 0; 

	while ($get_counts2 = mysql_fetch_assoc($get_counts))

		{ 
			mysql_query("COMMIT;");
			$count++;
			$price_total = $price_total + $get_counts2['price']; 

			}

			$get_products = mysql_query("SELECT p.id AS id, p.name AS name, st.name AS status, p.price AS price
				            FROM products p, status_table st WHERE p.status=st.id AND p.status!=9 AND p.product_type=0;");

			while ($get_products2 = mysql_fetch_assoc($get_products))
			{ ?>
			<tr>
				<td><?php echo $get_products2['name']; ?></td>
				<td><?php 

				$prod_id=$get_products2['id'];
				$get_cnt = mysql_query("SELECT COUNT(transId) AS cnt, productID FROM product_trans WHERE receiptValidated=1 AND productId=".$prod_id.";"); 
				$get_cnt2 = mysql_fetch_assoc($get_cnt);
				echo $get_cnt2['cnt']; 

				 ?></td> 
				<td><?php

				$price_total_gold=$get_cnt2['cnt']*$get_products2['price'];
				$cnt_gold=$count;
				echo $price_total_gold." $"; ?></td> 
			</tr>		
		<?php
		}
		?>
			<tr>
				<td>Chips total</td>
				<td><?php echo $count; ?></td>
				<td><?php echo $price_total. " $"; ?></td>
			</tr>
		</tbody>
	</table>
	<br>
	<table class="table">
		<thead>
			<tr>
				<th class="center">Quantity</th><th class="small10">Value</th>
			</tr>
		</thead>
		<tbody> 
			<tr>
				<td class="center"><?php echo $cnt_chips+$cnt_gold; ?></td><td class="small10"><?php echo $price_total_gold+$price_total_chips." $"; ?></td> 
			</tr>
		</tbody>
	</table>
	<br>
<?php ?>