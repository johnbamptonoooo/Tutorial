<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname = "{POKERVELVET_DB_IP}:3306";
$database = "pokervelvet";
$username = "pokeruser";
$password = "dsaewq321!";
$connect = mysql_pconnect($hostname, $username, $password) or trigger_error(mysql_error(), E_USER_ERROR);
?>
