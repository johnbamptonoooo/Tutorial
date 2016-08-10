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
getHeader('Admins', true);

?>

	<header class="container limited page-title">
		<h1>Admins</h1>
	</header>
	
	<section class="container limited">
		
		<?php	
		
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
			$get_admins = mysql_query("SELECT u.id AS id, u.name AS name, u.surname AS surname, st.name AS status, u.location AS location,
		                  u.username AS username, u.avatar AS avatar FROM users u, status_table st WHERE u.status=st.id AND u.status!=9
		                  AND user_type=0;");		

			?>
			
			<table class="table">
				<thead>
					<tr>
						<th class="small1">Avatar</th>
						<th>Username</th>
						<th>Name</th>
						<th>Surname</th>
						<th class="small10">Status</th>
						<th class="small10">Location</th>
						<th class="small1">Action</th>
					</tr>
				</thead>
				<tbody>
					
					<?php

					while ($get_admins2 = mysql_fetch_assoc($get_admins))
					{ ?>
						<tr>
							
							<?php
							
							if ($get_admins2['avatar'] != '')
							{ ?>
								<td><div class="image-preview"
									 style="background-image: url('../velvetpoker/assets/users/<?php echo $get_admins2['avatar']; ?>')">
									</div>
								</td>
							
								<?php
							}
							else
							{ ?>
								<td><div class="image-preview"
									 style="background-image: url('../velvetpoker/assets/users/Default.jpg')">
									</div>
								</td>

								<?php
							}

							?>
							
							<td><?php echo $get_admins2['username']; ?></td>
							<td><?php echo $get_admins2['name']; ?></td>
							<td><?php echo $get_admins2['surname']; ?></td>
							<td style="text-align:center"><?php echo $get_admins2['status']; ?></td>
							<td><?php echo $get_admins2['location']; ?></td>
							<td class="center"><a href="editAdmin.php?id=<?php echo $get_admins2["id"]; ?>" class="edit-button"></a></td>
						</tr>
					
					<?php

					}

					?>	
				
				</tbody>
			</table>

			<?php

		}

		//commit transaction
		mysql_query("COMMIT;");

		?>

	</section>

<?php getFooter(); ?>