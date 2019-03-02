<?php 
	require_once('../includes/db.php');
	require_once('../classes/category.class.php');
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
	}
	if (isset($_GET['submit'])) {
		$c = new Category;
		if($c->updateCategory($_SESSION['id'], strtolower($_GET['name']), strtolower($_GET['parent_name']))){
			$_GET['name'] = '';
			$_GET['parent_name'] = '';
		}
	}
	?>
	<form action="editcategory.php" method="GET">
		<input type="text" name="name" value="<?php echo $_GET['name'] ?>"> : Name<br>
		<input type="text" name="parent_name" value="<?php echo $_GET['parent_name'] ?>"> : Parent Category Name<br>
		<input type="submit" name="submit" value="submit!"><br>
	</form>
</body>
</html>