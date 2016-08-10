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
getHeader('Users', true);

?>

	<header class="container limited page-title">
		<h1>Users</h1>
	</header>

	<script type="text/javascript">

	$(document).ready(function()
	{
		$.get("editAvatar_get.php",	
									
	 	function(data)
	 	{
	 		$("#user_list").html(data);
	 	});
	});

	function search_users(inputString)
	{			
		$.post("editAvatar_get.php", {search_string: ""+inputString+""},

		function(data)
		{
			$("#user_list").html(data);			
		});
	}

	</script>
	<form action="editAvatar_update.php" method="POST">
	<section class="container limited">

		<form name="product_form" action="" method="">
			<div class="cf">
				<div class="half-form left">
					<div>
						<label for="search_user">Search users:</label>
						<input type="text" size="20" id="search_user" name="search_user" placeholder="Start typing for search..."
						 onKeyUp="search_users(this.value);">
						 	<div class="mt20">
						<button type="submit" class="btn insert">Set Default</button>
							</div>
					</div>
				</div>
			</div>
		</div>

		<br />
		
		<div id="user_list"></div>

	</section>
</form>
<?php getFooter(); ?>