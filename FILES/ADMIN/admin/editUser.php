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
getHeader('Edit user', true);

?>
	<header class="container limited page-title">
		<h1>Edit user</h1>
	</header>
	
	<section class="container limited">
		
		<h5 class="error">

		<?php

		if (isset($_SESSION['username_exists']))
		{
			echo $_SESSION['username_exists'];
			unset($_SESSION['username_exists']);
		}

		if (isset($_SESSION['update_user']))
		{
			echo $_SESSION['update_user'];
			unset($_SESSION['update_user']);
		}

		?>

		</h5>
		
		<?php 

		if (isset($_GET['id']))
		{	
			$product_id = mysql_real_escape_string(trim($_GET['id']));
			
			mysql_query("SET NAMES 'utf8'");
			
			//start transaction
			mysql_query("SET AUTOCOMMIT=0;");
			mysql_query("START TRANSACTION;");
			
			$get_user = mysql_query("SELECT u.id AS id, st.name AS status_name, u.status AS status, u.name AS name, u.surname AS surname,
				        u.location AS location, u.email AS email, u.nickname AS nickname, u.password AS password, u.chips AS chips,
				        u.gold AS gold FROM users u, status_table st WHERE u.id=".$product_id." AND u.status=st.id;");
			

			$get_user2 = mysql_fetch_assoc($get_user); ?>
		
			<form name="product_form" action="editUser2.php" method="post">
				<div class="cf">
					<div class="half-form fleft">
						
						<div>
							<label for="name">Name</label>
							<input type="text" size="20" name="name" value="<?php echo $get_user2['name']; ?>">
						</div>
						<div>
							<label for="surname">Surname</label>
							<input type="text" size="20" name="surname" value="<?php echo $get_user2['surname']; ?>">
						</div>
						<div>
							<label for="email">E-mail</label>
							<input type="text" size="20" name="email" value="<?php echo $get_user2['email']; ?>">
						</div>
						<div>
							<label for="password">Password</label>
							<input type="password" size="20" name="password" value="<?php echo $get_user2['password']; ?>">
						</div>
						<div>
							<label for="gold">Gold</label>
							<input type="text" size="20" name="gold" value="<?php echo $get_user2['gold']; ?>">
						</div>
						
					</div>
					<div class="half-form fleft">
						
						<div>
							<label for="status">Status</label>
							<select name="status" id="status">
								
								<?php

								$get_status = mysql_query("SELECT * FROM status_table;");
								
								while ($get_status2 = mysql_fetch_assoc($get_status))
								{
									echo "<option value=".$get_status2['id'].">".$get_status2['name']."</option>";
								} ?>
							
							</select>
							
							<script type="text/javascript">
								document.getElementById("status").value = "<?php echo $get_user2['status']; ?>";
							</script>
						
						</div>
						<div>
							<label for="location">Location</label>
							<input type="text" size="20" name="location" value="<?php echo $get_user2['location']; ?>">
						</div>
						<div>
							<label for="nickname">Nickname</label>
							<input type="text" size="20" name="nickname" value="<?php echo $get_user2['nickname']; ?>"> 
						</div>
						<div>
							<label for="chips">Chips</label>
							<input type="text" size="20" name="chips" value="<?php echo $get_user2['chips']; ?>">
						</div>
						
					</div>
				</div>
				<div class="center mt20">
					<input type="hidden" name="id" value="<?php echo $get_user2['id']; ?>">
					<button type="submit" class="btn insert">Update</button>
					<button type="button" onclick="window.location='users.php'" class="btn cancel">Cancel</button>
				</div>
			</form>
			
			<?php

			//commit transaction
			mysql_query("COMMIT;");
		}
		?>
	
	</section>

<?php getFooter(); ?>