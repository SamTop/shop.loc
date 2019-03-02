<?php 
	require_once('/includes/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php if(isset($_SESSION['user'])){
		echo "Hello, ".$_SESSION['user']['username']."!";
		echo '<a href="includes/logout.php">Log out</a><br>';
		
	} else { ?>
	<a href="includes/login.php">Login</a><br>
	<a href="includes/register.php">Register</a>
	<?php } ?>
</body>
</html>