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
getHeader('New admin', true);

?>
	<header class="container limited page-title">
		<h1>New admin</h1>
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

		if (isset($_SESSION['insert_admin']))
		{
			echo "<h5 class='error'>";
			echo $_SESSION['insert_admin'];
			unset($_SESSION['insert_admin']);
			echo "</h5>";
		}		
		
		mysql_query("SET NAMES 'utf8'");
		
		//start transaction
		mysql_query("SET AUTOCOMMIT=0;");
		mysql_query("START TRANSACTION;");

		$current_admin = mysql_real_escape_string(trim($_SESSION["admin"]));

		//check admin, display admins only if user_type=777
		$check_admin = mysql_query("SELECT user_type FROM users WHERE username='".$current_admin."';");
		$check_admin2 = mysql_fetch_assoc($check_admin);

		if ($check_admin2["user_type"] == 777)
		{ ?>
			
			<form name="product_form" action="newAdmin2.php" method="post" enctype="multipart/form-data">
				<div class="cf">
					<div class="half-form fleft">
						
						<div>
							<label for="name">Name</label>
							<input type="text" size="20" name="name">
						</div>
						<div>
							<label for="surname">Surname</label>
							<input type="text" size="20" name="surname">
						</div>
						<div>
							<label for="email">E-mail</label>
							<input type="text" size="20" name="email">
						</div>
						<div>
							<label for="password">Password</label>
							<input type="password" size="20" name="password">
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
						</div>
						<div>
							<label for="location">Location</label>
							<input type="text" size="20" name="location">
						</div>
						<div>
							<label for="username">User name</label>
							<input type="text" size="20" name="username">
						</div>							
						<div>
							<label for="avatar_path">Avatar</label>
							<input type="file" name="avatar_path">
						</div>
					</div>
				</div>
				<div class="center mt20">					
					<button type="submit" class="btn insert">Insert</button>
					<button type="button" onclick="window.location='admins.php'" class="btn cancel">Cancel</button>
				</div>
			</form>

			<?php
		}

		?>
	
	</section>

<?php getFooter(); ?>