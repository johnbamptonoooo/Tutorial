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

include('displays.php');
getHeader('Gifts', true);

?>
	<header class="container limited page-title">
		<h1>Gifts</h1>
	</header>
	
	<section class="container limited">
		
		<?php	
		
		//start transaction
		mysql_query("SET AUTOCOMMIT=0;");
		mysql_query("START TRANSACTION;");
		
		$get_products = mysql_query("SELECT g.id AS id, g.name AS name, st.name AS status, g.price_gold AS price_gold,
						g.price_chips AS price_chips, g.imagePath AS image FROM gifts g, status_table st WHERE g.status=st.id
						AND g.status!=9;");
		
		//commit transaction
		mysql_query("COMMIT;");
		
		?>
		
		<table class="table">
			<thead>
				<tr>
					<th class="small1">Preview</th>
					<th>Name</th>
					<th class="small10">Status</th>
					<th class="small10">Price gold</th>
					<th class="small10">Price chips</th>
					<th class="small1">Action</th>
				</tr>
			</thead>
			<tbody>
			
			<?php

			while ($get_products2 = mysql_fetch_assoc($get_products))
			{ ?>
				<tr>
					<td><div class="image-preview"
						 style="background-image: url('../velvetpoker/assets/gifts/<?php echo $get_products2['image']; ?>')"></div>
					</td>
					<td><?php echo $get_products2['name']; ?></td>
					<td><?php echo $get_products2['status']; ?></td>
					<td class="right"><?php echo $get_products2['price_gold']; ?></td>
					<td class="right"><?php echo $get_products2['price_chips']; ?></td>
					<td class="center"><a href="editGift.php?id=<?php echo $get_products2["id"]; ?>" class="edit-button"></a></td>
				</tr>
			
			<?php

			}

			?>
			
			</tbody>
		</table>
	</section>

<?php getFooter(); ?>