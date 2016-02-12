<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cn = "localhost:8889";
$database_cn = "storedb";
$username_cn = "root";
$password_cn = "root";
$cn = mysql_pconnect($hostname_cn, $username_cn, $password_cn) or trigger_error(mysql_error(),E_USER_ERROR); 
?>