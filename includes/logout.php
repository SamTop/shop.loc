<?php
require_once('../includes/db.php');
unset($_SESSION['user']);
header('Location: /');
?>