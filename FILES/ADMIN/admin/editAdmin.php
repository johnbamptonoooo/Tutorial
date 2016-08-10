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
getHeader('Edit admin', true);

?>
	<header class="container limited page-title">
		<h1>Edit admin</h1>
	</header>
	
	<section class="container limited">	

		<?php

		if (isset($_SESSION['username_exists']))
		{
			echo "<h5 class='error'>";
			echo $_SESSION['username_exists'];
			unset($_SESSION['username_exists']);
			echo "</h5>";
		}

		if (isset($_SESSION['update_admin']))
		{
			echo "<h5 class='error'>";
			echo $_SESSION['update_admin'];
			unset($_SESSION['update_admin']);
			echo "</h5>";
		}

		if (isset($_GET['id']))
		{	
			$admin_id = mysql_real_escape_string(trim($_GET['id']));			
			
			mysql_query("SET NAMES 'utf8'");
			
			//start transaction
			mysql_query("SET AUTOCOMMIT=0;");
			mysql_query("START TRANSACTION;");

			$current_admin = mysql_real_escape_string(trim($_SESSION["admin"]));

			//check admin, display admins only if user_type=777
			$check_admin = mysql_query("SELECT user_type FROM users WHERE username='".$current_admin."';");
			$check_admin2 = mysql_fetch_assoc($check_admin);

			if ($check_admin2["user_type"] == 777)
			{			
				$get_admin = mysql_query("SELECT u.id AS id, st.name AS status_name, u.status AS status, u.name AS name, u.surname AS surname,
					         u.location AS location, u.email AS email, u.username AS username, u.password AS password, u.avatar AS avatar
					         FROM users u, status_table st WHERE u.id=".$admin_id." AND u.status=st.id;");			

				$get_admin2 = mysql_fetch_assoc($get_admin);

				?>

				<div class="mb20">
			
				<?php

				// if there's no avatar show default avatar		
				if ($get_admin2['avatar'] != "")
				{ ?>
					<div class="image-preview-stay"
					 style="background-image: url('../velvetpoker/assets/users/<?php echo $get_admin2['avatar']; ?>')">
					</div>
					
					<?php
				}
				else
				{ ?>
					<div class="image-preview-stay" style="background-image: url('../velvetpoker/assets/users/Default.jpg')">
					</div>
					
					<?php
				}		
				

				?>
			
				</div>
				
				<form name="product_form" action="editAdmin2.php" method="post" enctype="multipart/form-data">
					<div class="cf">
						<div class="half-form fleft">
							
							<div>
								<label for="name">Name</label>
								<input type="text" size="20" name="name" value="<?php echo $get_admin2['name']; ?>">
							</div>
							<div>
								<label for="surname">Surname</label>
								<input type="text" size="20" name="surname" value="<?php echo $get_admin2['surname']; ?>">
							</div>
							<div>
								<label for="email">E-mail</label>
								<input type="text" size="20" name="email" value="<?php echo $get_admin2['email']; ?>">
							</div>
							<div>
								<label for="password">Password</label>
								<input type="password" size="20" name="password" value="<?php echo $get_admin2['password']; ?>">
							</div>							
							
						</div>
						<div class="half-form fleft">
							
							<div>
								<label for="status">Status</label>
								<select name="status" id="status">
									
									<?php $get_status = mysql_query("SELECT * FROM status_table;");
									
									while ($get_status2 = mysql_fetch_assoc($get_status))
									{
										echo "<option value=".$get_status2['id'].">".$get_status2['name']."</option>";
									} ?>
								
								</select>
								
								<script type="text/javascript">
									document.getElementById("status").value = "<?php echo $get_admin2['status']; ?>";
								</script>
							
							</div>
							<div>
								<label for="location">Location</label>
								<input type="text" size="20" name="location" value="<?php echo $get_admin2['location']; ?>">
							</div>
							<div>
								<label for="username">User name</label>
								<input type="text" size="20" name="username" value="<?php echo $get_admin2['username']; ?>">
							</div>							
							<div>
								<label for="avatar_path">Avatar</label>
								<input type="file" name="avatar_path">
							</div>
						</div>
					</div>
					<div class="center mt20">
						<input type="hidden" name="id" value="<?php echo $get_admin2['id']; ?>">
						<button type="submit" class="btn insert">Update</button>
						<button type="button" onclick="window.location='admins.php'" class="btn cancel">Cancel</button>
					</div>
				</form>

				<?php
			}
		}

		?>
	
	</section>

<?php getFooter(); ?>