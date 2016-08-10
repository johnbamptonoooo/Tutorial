<?php

require_once('connections/db_connection.php');

mysql_select_db($database, $connect);
mysql_query("SET NAMES 'utf8'");

if (isset($_POST["search_string"]))
{
	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");

	$product = mysql_real_escape_string(trim($_POST["search_string"]));

	$get_products = mysql_query("SELECT p.id AS id, p.name AS name, st.name AS status, p.price AS price
		            FROM products p, status_table st WHERE p.status=st.id AND p.status!=9 AND p.name LIKE '%$product%';");

	$count_products = mysql_num_rows($get_products);

	//commit transaction
	mysql_query("COMMIT;");

	if ($count_products > 0)
	{ ?>

		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th class="small10">Status</th>
					<th class="small10">Price</th>
					<th class="small1">Action</th>
				</tr>
			</thead>
			<tbody>
			
			<?php

			while ($get_products2 = mysql_fetch_assoc($get_products))
			{ ?>
				<tr>
					<td><?php echo $get_products2['name']; ?></td>
					<td><?php echo $get_products2['status']; ?></td>
					<td class="right"><?php echo $get_products2['price']; ?></td>
					<td class="center"><a href="editProduct.php?id=<?php echo $get_products2["id"]; ?>" class="edit-button"></a></td>
				</tr>
			
			<?php

			}

			//commit transaction
			mysql_query("COMMIT;");

			?>
			
			</tbody>
		</table>

		<?php

	}
	else
	{
		echo "No product like '".$product."'";	
	}

}
else
{
	//start transaction
	mysql_query("SET AUTOCOMMIT=0;");
	mysql_query("START TRANSACTION;");
		
	$get_products = mysql_query("SELECT p.id AS id, p.name AS name, st.name AS status, p.price AS price
		            FROM products p, status_table st WHERE p.status=st.id AND p.status!=9;");
	
	?>
	
	<table class="table">
		<thead>
			<tr>
				<th>Name</th>
				<th class="small10">Status</th>
				<th class="small10">Price</th>
				<th class="small1">Action</th>
			</tr>
		</thead>
		<tbody>
		
		<?php

		while ($get_products2 = mysql_fetch_assoc($get_products))
		{ ?>
			<tr>
				<td><?php echo $get_products2['name']; ?></td>
				<td><?php echo $get_products2['status']; ?></td>
				<td class="right"><?php echo $get_products2['price']; ?></td>
				<td class="center"><a href="editProduct.php?id=<?php echo $get_products2["id"]; ?>" class="edit-button"></a></td>
			</tr>
		
		<?php

		}

		//commit transaction
		mysql_query("COMMIT;");

		?>
		
		</tbody>
	</table>

	<?php
}

?>