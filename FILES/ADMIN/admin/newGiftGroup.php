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

include('displays.php');
getHeader('New gift group', true);

?>
	<header class="container limited page-title">
		<h1>New gift group</h1>
	</header>
	
	<section class="container limited">	

		<?php

		if (isset($_SESSION['insert_group']))
		{
			echo "<h5 class='error'>";
			echo $_SESSION['insert_group'];
			unset($_SESSION['insert_group']);
			echo "</h5>";
		}

		?>	
		
		<form name="group_form" action="newGiftGroup2.php" method="post">
			<div class="cf">
				<div class="half-form fmid">
					<div>
						<label for="name">Name</label>
						<input type="text" size="20" name="name" id="name">
					</div>
				</div>
			</div>
			<div class="center mt20">
				<button type="submit" class="btn insert">Insert</button>
				<button type="button" onclick="window.location='giftGroups.php'" class="btn cancel">Cancel</button>
			</div>
		</form>
		
	</section>

<?php getFooter(); ?>