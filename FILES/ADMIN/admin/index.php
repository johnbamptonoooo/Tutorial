<?php

session_start();

ini_set('display_errors', 'On');
error_reporting(E_ALL | E_STRICT);

//if user is logged in redirect to home page
if (isset($_SESSION['username']))
{
	//check user type (user/admin)
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/myProfile.php");
	exit;
}
//if user is logged in redirect to home page
elseif (isset($_SESSION['admin']))
{
	//check user type (user/admin)
	$host=$_SERVER["HTTP_HOST"];
	$path=rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
	header("Location: http://$host$path/products.php");
	exit;
}

include('displays.php');
getHeader('Sign in');

?>
	<header class="container">
		<div class="login-logo"></div>
	</header>
	
	<section class="container limited">
		<div class="login-form">
			<form action="login.php" method="post">
				
				<?php

				if (isset($_SESSION['login_error']))
				{
					echo "<h5>Invalid user name and/or password!</h5>";
					unset($_SESSION['login_error']);
				}

				?>
				
				<label for="username">E-mail</label>
				<input type="text" name="username" required="required" placeholder="email@domain.com" class="mb10">
				<label for="password">Password</label>
				<input type="password" name="password" required="required" placeholder="password" class="mb20">
				<div class="center">
					<button type="submit">Sign in</button>
				</div>
			</form>
		</div>
	</section>

<?php getFooter(); ?>