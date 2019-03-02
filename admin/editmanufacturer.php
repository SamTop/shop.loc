<?php 
	require_once('../includes/db.php');
	require_once('../classes/manufacturer.class.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
	if(!isset($_GET['submit'])) {
		$_SESSION['id'] = $_GET['id'];
		$id = $_SESSION['id'];
	}
	if (isset($_GET['submit'])) {
		$m = new Manufacturer;
		$m->updateManufacturer($_SESSION['id'], $_GET['name'], $_GET['address'], $_GET['phone']);
	}
	?>
	<form action="editmanufacturer.php" method="GET">
		<input type="text" name="name" value="<?php echo $_GET['name'] ?>"> : Name<br>
		<input type="text" name="address" value="<?php echo $_GET['address'] ?>"> : Address<br>
		<input type="text" name="phone" value="<?php echo $_GET['phone'] ?>"> : Phone<br>
		<input type="submit" name="submit" value="submit!"><br>
	</form>
</body>
</html>