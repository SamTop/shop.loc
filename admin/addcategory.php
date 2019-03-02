<?php
	require_once('../includes/db.php'); 
	require_once('../classes/category.class.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<title>Document</title>
</head>
<body>
	<?php
		if (isset($_GET['submit']))
		{
			$c = new Category;
			if($c->createCategory(strtolower($_GET['name']), strtolower($_GET['parent_cat'])))	{
				$_GET['name'] = '';
				$_GET['parent_cat'] = '';
			}
		}
	?>
	<form action="addcategory.php" method="GET">
		<input type="text" name="name" value="<?php echo $_GET['name'] ?>"> : Name <br>
		<input type="text" name="parent_cat" value="<?php echo $_GET['parent_cat'] ?>"> : Parent category name <br>
		<input type="submit" name="submit" value="Add">
	</form>
</body>
</html>