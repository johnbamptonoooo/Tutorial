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
getHeader('Edit gift group', true);

?>

	<header class="container limited page-title">
		<h1>Edit gift group</h1>
	</header>
	
	<section class="container limited">	

		<?php

		if (isset($_SESSION['update_group']))
		{
			echo "<h5 class='error'>";
			echo $_SESSION['update_group'];
			unset($_SESSION['update_group']);
			echo "</h5>";
		}

		if (isset($_GET['id']))
		{
			$group_id = mysql_real_escape_string(trim($_GET['id']));
			
			mysql_query("SET NAMES 'utf8'");
			
			//start transaction
			mysql_query("SET AUTOCOMMIT=0;");
			mysql_query("START TRANSACTION;");
			
			$get_group = mysql_query("SELECT id, name FROM gift_groups WHERE id=".$group_id.";");
			
			//commit transaction
			mysql_query("COMMIT;");
			
			$get_group2 = mysql_fetch_assoc($get_group); ?>
		
			<form name="group_form" action="editGiftGroup2.php" method="post">
				<div class="cf">
					<div class="half-form fmid">
						<div>
							<label for="name">Name</label>
							<input type="text" size="20" name="name" id="name" value="<?php echo $get_group2['name']; ?>">
						</div>
					</div>
				</div>
				<div class="center mt20">
					<input type="hidden" name="id" value="<?php echo $get_group2['id']; ?>">
					<button type="submit" class="btn insert">Update</button>
					<button type="button" onclick="window.location='giftGroups.php'" class="btn cancel">Cancel</button>
					<button type="button" onclick="delete_group('<?php echo $get_group2['id']; ?>')" id="delete_button"
					 class="btn delete">Delete</button>
					
					<script type="text/javascript">
					
					function delete_group(id)
					{
						if (confirm("Delete this group?"))
						{
							location.href = 'delete_group.php?id=' + id;
						}
					}

					</script>
				
				</div>
			</form>
		
		<?php } ?>
	</section>

<?php getFooter(); ?>