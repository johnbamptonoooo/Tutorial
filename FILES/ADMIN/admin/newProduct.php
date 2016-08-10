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
getHeader('New product', true);

?>
	<header class="container limited page-title">
		<h1>New product</h1>
	</header>
	
	<section class="container limited">		

		<?php

		if (isset($_SESSION['insert_product']))
		{
			echo "<h5 class='error'>";
			echo $_SESSION['insert_product'];
			unset($_SESSION['insert_product']);
			echo "</h5>";
		}

		?>	
		
		<form name="product_form" action="newProduct2.php" method="post">
			<div class="cf">
				<div class="half-form fleft">
					
					<div>
						<label for="name">Name</label>
						<input type="text" size="20" name="name">
					</div>
					<div>
						<label for="quantity">Quantity</label>
						<input type="text" size="20" name="quantity">
					</div>
					<div>
						<label for="description">Description</label>
						<input type="text" size="20" name="description">
					</div>
					<div>
						<label for="product_id">Product ID</label>
						<input type="text" size="20" name="product_id">
					</div>
					
				</div>
				<div class="half-form fright">
					
					<div>
						<label for="status">Status</label>
						<select name="status" id="status">
							
							<?php
							
							//start transaction
							mysql_query("SET AUTOCOMMIT=0;");
							mysql_query("START TRANSACTION;");
							
							$get_status = mysql_query("SELECT * FROM status_table;");
							
							//commit transaction
							mysql_query("COMMIT;");
							
							while ($get_status2 = mysql_fetch_assoc($get_status))
							{
								echo "<option value=".$get_status2['id'].">".$get_status2['name']."</option>";
							}

							?>
						</select>
					</div>
					<div>
						<label for="price">Price</label>
						<input type="text" size="20" name="price" id="price">
					</div>
					<div>
						<label for="type">Type</label>
						<select name="type" id="type">
							<option value="0">Standard product</option>
							<option value="1">Promotional product</option>
						</select>
					</div>
					<div>
						<label for="product_type">Product type</label>
						<select name="product_type" id="product_type">
							<option value="0">Chips</option>
							<option value="1">Gold</option>
						</select>
					</div>
					
				</div>
			</div>
			<div class="center mt20">
				<button type="submit" class="btn insert">Insert</button>
				<button type="button" onclick="window.location='products.php'" class="btn cancel">Cancel</button>
			</div>
		</form>
	</section>

<?php getFooter(); ?>