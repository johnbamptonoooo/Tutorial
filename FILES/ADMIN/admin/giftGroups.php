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
getHeader('Gift groups', true);

?>
	<header class="container limited page-title">
		<h1>Gift groups</h1>
	</header>
	
	<section class="container limited">
		
		<?php	
		
		//start transaction
		mysql_query("SET AUTOCOMMIT=0;");
		mysql_query("START TRANSACTION;");
		
		$get_groups = mysql_query("SELECT id , name FROM gift_groups;");
		
		//commit transaction
		mysql_query("COMMIT;");
		
		?>
		
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th class="small1">Action</th>
				</tr>
			</thead>
			<tbody>
				
				<?php

				while ($get_groups2 = mysql_fetch_assoc($get_groups))
				{ ?>
					<tr>
					<td><?php echo $get_groups2['name']; ?></td>
					<td class="center"><a href="editGiftGroup.php?id=<?php echo $get_groups2["id"]; ?>" class="edit-button"></a></td>
				</tr>
				
				<?php

				}

				?>

			</tbody>
		</table>
	</section>

<?php getFooter(); ?>