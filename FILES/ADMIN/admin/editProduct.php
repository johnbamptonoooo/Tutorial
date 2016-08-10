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
getHeader('Edit product', true);

?>
	<header class="container limited page-title">
		<h1>Edit product</h1>
	</header>
	
	<section class="container limited">	

		<?php

		if (isset($_SESSION['update_product']))
		{
			echo "<h5 class='error'>";
			echo $_SESSION['update_product'];
			unset($_SESSION['update_product']);
			echo "</h5>";
		}

		if (isset($_GET['id']))
		{
			$product_id = mysql_real_escape_string(trim($_GET['id']));			
			
			mysql_query("SET NAMES 'utf8'");
			
			//start transaction
			mysql_query("SET AUTOCOMMIT=0;");
			mysql_query("START TRANSACTION;");

			$get_product = mysql_query("SELECT p.id AS id, st.name AS status_name, p.status AS status, p.name AS name,
				           p.quantity AS quantity, p.price AS price, p.description AS description, p.type AS type, p.productId AS prod_id,
				           p.product_type AS prod_type FROM products p, status_table st WHERE p.id=".$product_id." AND p.status=st.id;");
			$get_product2 = mysql_fetch_assoc($get_product); ?>
		
			<form name="product_form" action="editProduct2.php" method="post">
				<div class="cf">
					<div class="half-form fleft">
						
						<div>
							<label for="name">Name</label>
							<input type="text" size="20" name="name" value="<?php echo $get_product2['name']; ?>">
						</div>
						<div>
							<label for="quantity">Quantity</label>
							<input type="text" size="20" name="quantity" value="<?php echo $get_product2['quantity']; ?>">
						</div>
						<div>
							<label for="description">Description</label>
							<input type="text" size="20" name="description" value="<?php echo $get_product2['description']; ?>">
						</div>
						<div>
							<label for="product_id">Product ID</label>
							<input type="text" size="20" name="product_id" value="<?php echo $get_product2['prod_id']; ?>">
						</div>
						
					</div>
					<div class="half-form fright">
						
						<div>
							<label for="status">Status</label>
							<select name="status" id="status">
								<?php $get_status = mysql_query("SELECT * FROM status_table;");
								while ($get_status2 = mysql_fetch_assoc($get_status)) {
									echo "<option value=".$get_status2['id'].">".$get_status2['name']."</option>";
								} ?>
								<script type="text/javascript">
									document.getElementById('status').value = "<?php echo $get_product2['status']; ?>";
								</script>
							</select>
						</div>
						<div>
							<label for="price">Price</label>
							<input type="text" size="20" name="price" value="<?php echo $get_product2['price']; ?>">
						</div>
						<div>
							<label for="type">Type</label>
							<select name="type" id="product_type">
								<option value="0">Standard product</option>
								<option value="1">Promotional product</option>
							</select>
							<script type='text/javascript'>
								document.getElementById('product_type').value = "<?php echo $get_product2['type']; ?>";
							</script>
						</div>
						<div>
							<label for="p_type">Product type</label>
							<select name="p_type" id="prod_type">
								<option value="0">Chips</option>
								<option value="1">Gold</option>
							</select>
							<script type="text/javascript">
								document.getElementById('prod_type').value = "<?php echo $get_product2['prod_type']; ?>";
							</script>
						</div>
						
					</div>
				</div>
				<div class="center mt20">
					<input type="hidden" name="id" value="<?php echo $get_product2['id']; ?>">
					<button type="submit" class="btn insert">Update</button>
					<button type="button" onclick="window.location='products.php'" class="btn cancel">Cancel</button>
				</div>
			</form>
		
			<?php

			//commit transaction
			mysql_query("COMMIT;");
		}

		?>

	</section>

<?php getFooter(); ?>