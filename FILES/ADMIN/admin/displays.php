<?php

/* Function to display the header tags in each file */
function getHeader($title, $inHeader = false, $inUser = false) { ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<meta name="rating" content="General">
<meta name="robots" content="FOLLOW,INDEX">
<meta name="robots" content="all">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css" media="screen">
<link rel="shortcut icon" href="favicon.ico">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
 <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <script>
$(function() {
$( "#datepicker_from" ).datepicker();
}); 
$(function() {
$( "#datepicker_to" ).datepicker(); 
});
</script>
</head> 
<body> 
<?php if ($inHeader == true) { // display top menu for logged in admins ?>
	<header class="container bck-black">
		<div class="container limited cf">
			<a href="products.php" class="mini-logo"></a>
			<a href="#" class="ac-menu-btn"></a>  
			<nav class="top-menu">
				<ul class="cf">  
					<li class="expaned-menu">
						<a href="home.php">Home</a>
						<ul class="cf">
							<li><a href="overviewChipsGold.php">Chips/Gold overview</a></li>
							<li><a href="overviewGifts.php">Gifts overview</a></li>
							<li><a href="overviewUsers.php">Users overview</a></li>
						</ul>
					<li class="expand-menu">Products
						<ul class="cf">
							<li><a href="newProduct.php">New product</a></li>
							<li><a href="products.php">Products</a></li>
						</ul>
					</li> 
					<li class="expand-menu">Gifts
						<ul class="cf">
							<li><a href="newGift.php">New gift</a></li>
							<li><a href="gifts.php">Gifts</a></li>
						</ul>
					</li>
					<li class="expand-menu">Gift groups
						<ul class="cf">
							<li><a href="newGiftGroup.php">New gift group</a></li>
							<li><a href="giftGroups.php">Gift groups</a></li>
						</ul>
					</li>

					<?php					

					//start transaction
					mysql_query("SET AUTOCOMMIT=0;");
					mysql_query("START TRANSACTION;");

					$current_user = mysql_real_escape_string(trim($_SESSION["admin"]));

					$get_user_type = mysql_query("SELECT user_type FROM users WHERE username='".$current_user."';");
					$get_user_type2 = mysql_fetch_assoc($get_user_type);

					if ($get_user_type2["user_type"] == 777)
					{ ?>
						<li class="expand-menu">Admins
							<ul class="cf">
								<li><a href='admins.php'>Admins</a></li>
								<li><a href="newAdmin.php">Add admin</a></li>
							</ul>
						</li>

						<?php
					}	
					else
					{ ?>
						<li class="expand-menu">Users
							<ul class="cf">
								<li><a href='users.php'>Users</a></li>
								<li><a href="editAvatar.php">Edit Users/Avatars</a></li>
								<li><a href="inactiveUsers.php">Inactive Users</a></li>
							</ul>
						</li>
						<li class="expand-menu"><a href="globalMessage.php">Global message</a>
						</li>
						<li class="expand-menu"><a href="clearCache.php">Clear cache</a>
						</li>

						<?php
					}

					//commit transaction
					mysql_query("COMMIT;");

					?>
					
					<li><a href="logout.php"><span>Sign out</span></a></li>
				</ul>
			</nav>
		</div>
	</header>
	
<?php }
if ($inUser == true) { // display top menu for logged in users ?>
	<header class="container bck-black">
		<div class="container limited cf">
			<a href="products.php" class="mini-logo"></a>
			<nav class="top-menu">
				<ul class="cf">
					<li><a href="logout.php"><span>Sign out</span></a></li>
				</ul>
			</nav>
		</div>
	</header>
<?php } } ?>


<?php
/* Function to display the footer tags in each file */
function getFooter() { ?>
<script>
	$(document).ready(function() {
		$('.expand-menu').click(function(event){
			$('.expand-menu').each(function(){
				$(this).removeClass('active');
			});
			$(this).addClass('active');
			event.stopPropagation();
		});
		$('.ac-menu-btn').click(function(event){
			if(!($('.top-menu').hasClass('active'))) {
				$('.top-menu').addClass('active');
			} else {
				$('.top-menu').removeClass('active');
			}
			event.stopPropagation();
		});
		$(window).resize(function(){
			$('.expand-menu').each(function(){
				$(this).removeClass('active');
			});
			$('.top-menu').removeClass('active');
		});
		$('body').click(function(){
			$('.expand-menu').each(function(){
				$(this).removeClass('active');
			});
			$('.top-menu').removeClass('active');
		});
	});
</script>
</body>
</html>
<?php } ?>