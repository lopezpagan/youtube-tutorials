<?php
$hostname_strcn = "localhost";//"127.0.0.1";
$database_strcn = "dbtest";
$username_strcn = "root";
$password_strcn = "root";
mysql_connect($hostname_strcn, $username_strcn, $password_strcn) or die(mysql_error());
mysql_select_db($database_strcn) or die(mysql_error());
?>
