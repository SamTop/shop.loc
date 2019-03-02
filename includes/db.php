<?php

$host = 'localhost';
$u = 'root';
$p = '';
$db = 'shop';
try {
	$pdo = new PDO('mysql:host=localhost;dbname=shop' , 'root', '');	
} catch (Exception $e) {
	die('Failed to connect to database');
}
/*$con = mysql_connect($host, $u, $p);
mysql_select_db($db);
if (!$con) {
	echo "failed";
}*/
session_start();
?>
