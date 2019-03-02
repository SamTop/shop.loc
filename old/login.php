<?php
	require_once('../includes/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
		// Submit is pressed
		if (isset($_POST['submit'])) {
			// Users with entered username
			$result = mysql_query("SELECT * FROM `users` WHERE username = '".$_POST['name']."'");
			$result = mysql_fetch_array($result);
			if(!$result){
				// If no user found
					echo "No user found with such username";
				} else {
				//If there is such user
					$password = $result['password'];
					if(password_verify($_POST['password'], $password)){
					// Passwords coincide
						echo "Logged in <br>";
						$_SESSION['user'] = $result;
						echo '<a href="/">Main Page</a>';
				} else {
				// Wrong password
					echo "Failed";
				}
			}
		}

	?>
	<form action="login.php" method="post">
		Username: <input type="text" name="name" value="<?php echo $_POST['name'] ?>"><br>
		Password: <input type="password" name="password"><br>
		<input type="submit" value="Submit" name="submit">
	</form>
</body>
</html>