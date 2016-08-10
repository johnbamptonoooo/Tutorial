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
getHeader('New gift', true);

?>
	<header class="container limited page-title">
		<h1>New gift</h1>
	</header>
	
	<section class="container limited">		

		<?php

		if (isset($_SESSION['insert_gift']))
		{
			echo "<h5 class='error'>";
			echo $_SESSION['insert_gift'];
			unset($_SESSION['insert_gift']);
			echo "</h5>";
		}

		?>		
		
		<form name="gift_form" action="newGift2.php" method="post" enctype="multipart/form-data">
			<div class="cf">
				<div class="half-form fleft">
					
					<div>
						<label for="name">Name</label>
						<input type="text" size="20" name="name">
					</div>
					<div>
						<label for="price_gold">Price gold</label>
						<input type="text" size="20" name="price_gold">
					</div>
					<div>
						<label for="">Group</label>
						<select name="group" id="group">
							<?php
							
							$get_group = mysql_query("SELECT * FROM gift_groups;");
							
							while ($get_group2 = mysql_fetch_assoc($get_group))
							{
								echo "<option value=".$get_group2['id'].">".$get_group2['name']."</option>";
							} ?>
						
						</select>
					</div>
					<div>
						<label for="">Exists in client</label>
						<select name="gift_type" id="gift_type">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
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
							} ?>
						
						</select>
					</div>
					<div>
						<label for="price_chips">Price chips</label>
						<input type="text" size="20" name="price_chips">
					</div>
					<div>
						<label for="description">Description</label>
						<input type="text" size="20" name="description">
					</div>
					<div>
						<label for="image_path">Image path</label>
						<input type="file" name="image_path">
					</div>
					
				</div>
			</div>
			<div class="center mt20">
				<button type="submit" class="btn insert">Insert</button>
				<button type="button" onclick="window.location='gifts.php'" class="btn cancel">Cancel</button>
			</div>
		</form>
		
	</section>

<?php getFooter(); ?>