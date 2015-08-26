<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_systemsticker_conn = "localhost";
$database_systemsticker_conn = "systemsticker_db";
$username_systemsticker_conn = "root";
$password_systemsticker_conn = "";
$systemsticker_conn = mysql_pconnect($hostname_systemsticker_conn, $username_systemsticker_conn, $password_systemsticker_conn) or trigger_error(mysql_error(),E_USER_ERROR);

mysql_select_db($database_systemsticker_conn);
?>