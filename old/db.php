<?php
$host = 'localhost';
$u = 'root';
$p = '';
$db = 'online_shop';
$con = mysql_connect($host, $u, $p);
mysql_select_db($db);

if (!$con) {
	echo "failed";
}
session_start();
?>