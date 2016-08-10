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
getHeader('Edit gift', true);

?>
	<header class="container limited page-title">
		<h1>Edit gift</h1>
	</header>
	
	<section class="container limited">	

		<?php

		if (isset($_SESSION['update_gift']))
		{
			echo "<h5 class='error'>";
			echo $_SESSION['update_gift'];
			unset($_SESSION['update_gift']);
			echo "</h5>";
		}

		if (isset($_GET['id']))
		{
			$gift_id = mysql_real_escape_string(trim($_GET['id']));
			
			mysql_query("SET NAMES 'utf8'");
			
			//start transaction
			mysql_query("SET AUTOCOMMIT=0;");
			mysql_query("START TRANSACTION;");
			
			$get_gift = mysql_query("SELECT g.id AS id, st.name AS status_name, g.status AS status, g.name AS name,
				        g.price_gold AS price_gold, g.price_chips AS price_chips, g.gift_group AS gift_group,g.existsInClient AS exist, g.description AS description,
				        g.imagePath AS image FROM gifts g, status_table st
				        WHERE g.id=".$gift_id." AND g.status=st.id;");
				
			$get_gift2 = mysql_fetch_assoc($get_gift);
			
			?>
			<div class="mb20">
				<div class="image-preview-stay" style="background-image: url('../velvetpoker/assets/gifts/<?php echo $get_gift2['image']; ?>')"></div>
			</div>
			<form name="gift_form" action="editGift2.php" method="post" enctype="multipart/form-data">
				<div class="cf">
					<div class="half-form fleft">
						
						<div>
							<label for="name">Name</label>
							<input type="text" size="20" name="name" value="<?php echo $get_gift2['name']; ?>">
						</div>
						<div>
							<label for="price_gold">Price gold</label>
							<input type="text" size="20" name="price_gold" value="<?php echo $get_gift2['price_gold']; ?>">
						</div>
						<div>
							<label for="group">Group</label>
							<select name="group" id="group">
							
							<?php
							
							//start transaction
							mysql_query("SET AUTOCOMMIT=0;");
							mysql_query("START TRANSACTION;");
							 
							$get_group = mysql_query("SELECT * FROM gift_groups;");
							
							//commit transaction
							mysql_query("COMMIT;");
							
							while ($get_group2 = mysql_fetch_assoc($get_group))
							{
								echo "<option value=".$get_group2['id'].">".$get_group2['name']."</option>";
							}

							?> 
							
							</select>
							
							<script type='text/javascript'>
								document.getElementById('group').value = "<?php echo $get_gift2['gift_group']; ?>";
							</script>
						
						</div>
						<div>
						<label for="">Exists in client</label>
						<select name="gift_type" id="gift_type">
							<?php

							if($get_gift2['exist']==1)
							{ ?>

							<option value="0">No</option>
							<option value="1" selected>Yes</option>

							<?php }
							else
							{
								?>
							<option value="0" selected>No</option>
							<option value="1" >Yes</option>
								<?php
							}

							?>

						</select>

						</div>
						
					</div>
					<div class="half-form fright">
						
						<div>
							<label for="gift_type">Gift type</label>
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
							
							<script type="text/javascript">
								document.getElementById('status').value = "<?php echo $get_gift2['status']; ?>";
							</script>

						</div>
						<div>
							<label for="price_chips">Price chips</label>
							<input type="text" size="20" name="price_chips" value="<?php echo $get_gift2['price_chips']; ?>">
						</div>
						<div>
							<label for="description">Description</label>
							<input type="text" size="20" name="description" value="<?php echo $get_gift2['description']; ?>">
						</div>
						<div>
							<label for="image_path">Image path</label>
							<input type="file" name="image_path">
						</div>
					</div>
				</div>
				<div class="center mt20">
					<input type="hidden" name="id" value="<?php echo $get_gift2['id']; ?>">
					<button type="submit" class="btn insert">Update</button>
					<button type="button" onclick="window.location='gifts.php'" class="btn cancel">Cancel</button>
				</div>
			</form>
			
			<?php

			//commit transaction
			mysql_query("COMMIT;");
		}

		?>

	</section>

<?php getFooter(); ?>