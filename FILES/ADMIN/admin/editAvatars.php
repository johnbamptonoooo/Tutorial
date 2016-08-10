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
getHeader('Avatars', true);

?>

	<header class="container limited page-title">
		<h1>Avatars</h1>
	</header>
	
	<section class="container limited">
		<form name="avatar_form" action="updateAvatars.php" method="post">
			<div class="center cf">
				
				<?php 
				
				//start transaction
				mysql_query("SET AUTOCOMMIT=0;");
				mysql_query("START TRANSACTION;");

				$count_avatars = 0;
				
				$get_avatars = mysql_query("SELECT id, show_avatar, avatar FROM users WHERE avatar!='';");
				$count_avatars = mysql_num_rows($get_avatars);
				
				//commit transaction
				mysql_query("COMMIT;");

				if ($count_avatars > 0)
				{				
					while ($get_avatars2 = mysql_fetch_assoc($get_avatars))
					{ ?>				
						<div class="avatar-element">
							<label>
								<div style="background-image: url('../velvetpoker/assets/users/<?php echo $get_avatars2['avatar']; ?>');"></div>								
								<input type="checkbox" name="path[]" id="<?php echo $get_avatars2['id']; ?>"
								 value="<?php echo $get_avatars2['id']; ?>"> Display
							</label>
						</div>
						
						<?php

						if ($get_avatars2['show_avatar'] == 1)
						{ ?>
							<script type="text/javascript">
								document.getElementById("<?php echo $get_avatars2['id']; ?>").checked = true;
							</script>
							
							<?php
						}
					}

					?>

					<div class="center mt20">
						<button type="submit" class="btn insert">Update</button>
					</div>

				<?php

				}

				?>
				
			</div>			
		</form>
	</section>

<?php getFooter(); ?>