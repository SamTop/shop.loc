<?php 
	require_once('../includes/db.php');
	require_once('../classes/register.class.php');  
	require_once('../classes/login.class.php');
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
		/*if (isset($_POST['submit'])){
			// If any field is left error occurs
			if (!$_POST['name']) $errors[] = "Enter name";
			if (!$_POST['email']) $errors[] = "Enter email";
			if (!$_POST['password']) $errors[] = "Enter password";
			// Are any errors?
			if (!$errors) {
				// If no errors check if username and email are unique
				$result = mysql_query("SELECT * FROM `users` WHERE username = '".$_POST['name']."' OR email = '".$_POST['email']."'");
				$result = mysql_fetch_array($result);
				if(!$result) {
					// If unique, register
					$sql = "INSERT INTO users (username, email, password)
							VALUES ('".$_POST['name']."', '".$_POST['email']."', '".password_hash($_POST['password'], PASSWORD_DEFAULT)."')";
					if(mysql_query($sql)) echo "You have been registered!";
					} else {
					// If not unique, show error message
						echo "The E-mail or username has been already registered.";
					}
			} else {
			// If any field is left, show error message
				echo array_shift($errors);
			}

		};*/
		// Submit is pressed
		if (isset($_POST['submit'])) 
		{
			// New Register object
			$user = new Register;
			if($user->createUser($_POST['name'], $_POST['password'], $_POST['email'])) {
				$login = new Login($_POST['name'], $_POST['password']);
				if ($login->validate())
				{
					if ($login->find_user())
					{
						if($login->check_pass())
						{
							$_SESSION['user'] = $login->user;
							echo "Registered";
							echo '<a href="/">Main Page</a>';
						}
						else
						{
							echo "Wrong password";
						}
					}
				}
			}
			
		}
	?>
	<form action="register.php" method="post">
		Name: <input type="text" name="name" value="<?php echo $_POST['name'] ?>"><br>
		E-mail: <input type="email" name="email" value="<?php echo $_POST['email'] ?>"><br>
		Password: <input type="password" name="password"><br>
		<input type="submit" value="Submit" name="submit">
	</form>
</body>
</html>