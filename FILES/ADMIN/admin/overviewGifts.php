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
getHeader('Products', true);

?>
	<header class="container limited page-title">
		<h1>Overview</h1>
	</header>

	<script type="text/javascript">

	$(document).ready(function()
	{
		$.get("getGiftsSold.php",	
									
	 	function(data)
	 	{
	 		$("#sold").html(data);
	 	}); 
	});
/*
	function search_products(inputString)
	{			
		$.post("getProducts.php", {search_string: ""+inputString+""},

		function(data)
		{
			$("#product_list").html(data);			
		});
	}
*/
	</script>
	
	<section class="container limited">

		<!--<form name="product_form" action="" method="">
			<div class="cf">
				<div class="half-form">
					<div>
						<label for="search_user">Search products:</label>
						<input type="text" size="20" id="search_product" name="search_user" placeholder="Start typing for search..."
						 onKeyUp="search_products(this.value);">
					</div>
				</div>
			</div>
		</div>

		<br />-->
		
		<div id="sold"></div>		
		
	</section>

<?php getFooter(); ?> 