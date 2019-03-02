<?php
	require_once('/db.php');
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
		if (isset($_POST['submit'])) {
			// Instantiate new Login object
			$login = new Login($_POST['name'], $_POST['password']);
			if ($login->validate())
			{
				if ($login->find_user())
				{
					if($login->check_pass())
					{
						$_SESSION['user'] = $login->user;
						echo "Logged in";
						echo '<a href="/">Main Page</a>';
					}
					else
					{
						echo "Wrong password";
					}
				}
			}
		}
		
	?>
	<?php if (!isset($_SESSION['user'])) { ?>
	<form action="login.php" method="post">
		Username: <input type="text" name="name" value="<?php echo $_POST['name'] ?>"><br>
		Password: <input type="password" name="password"><br>
		<input type="submit" value="Submit" name="submit">
	</form>
	<?php } ?>
</body>
</html>