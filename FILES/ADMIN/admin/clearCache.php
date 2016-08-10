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
mysql_query("SET NAMES 'utf8'");
mysql_query("SET AUTOCOMMIT=0;");
mysql_query("START TRANSACTION;");
include('displays.php');
getHeader('Users', true);

$username = $_SESSION['admin'];

$get_pass = mysql_query("SELECT password FROM users WHERE username='".$username."';");
$get_pass2= mysql_fetch_assoc($get_pass);
//echo  $get_pass2['password'] ;
  
?>
<!--
<script type="text/javascript">

function call_http_req()/*
           {
           var user = $('#username').val();
           var pass = $('#password').val();

           $.post("http://54.228.196.134:8080/PokerVelvet/carpo",
                  {

                   ww: ""+String(user)+"",
                   xx: ""+String(pass)+"",
                   yy: ""+"clear"+""
                   
                  }
                 );
           
         }*/
</script>-->
	<header class="container limited page-title">
		<h1>Clear Cache</h1>
	</header>

	<section class="container limited">
			<div class="cf">
				<div class="half-form left">
					<div> 
					<form action="http://54.200.55.241:8080/PokerVelvet/carpo" method="GET">
						<input type="text" size="20" value = "<?php echo $_SESSION['admin']; ?>" id="username" name="ww" placeholder="<?php echo $_SESSION['admin']; ?>" ><br><br> 
						<input type="password" size="20" value = "<?php echo $get_pass2['password']; ?>" id="password" name="xx" placeholder="<?php echo $get_pass2['password']; ?>" >
						<input type="text" name="yy" value="clear" style="display:none">
						 	<div class="mt20"> 
						<button type="submit"  class="btn insert">Send</button>
						</form>
							</div>
					</div>
				</div>
			</div>
		<br/>
	</section>

<?php getFooter(); ?>