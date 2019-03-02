<?php require_once('../includes/db.php'); ?>
<?php require_once('../classes/category.class.php'); ?>
<?php

$c = new Category;
if ($_GET['action'] == 'edit'){
	header("Location: editcategory.php?id=".$_GET['id']);
}
if ($_GET['action'] == 'del') {
	echo $c->deleteCategory($_GET['id']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<title>Document</title>
</head>
<body>
	<div class="menu">
		<ul>
			<li><a href="products.php">Products</a></li>
			<li><a href="categories.php">Categories</a></li>
			<li><a href="manufacturers.php">Manufacturers</a></li>
			<li><a href="orders.php">Orders</a></li>
		</ul>
	</div>
	<div class="main">
		<a class="add" href="addcategory.php">Add</a><br><br>
		<table>
			<tr>
				<th>Name</th>
			</tr>
		<?php
			
			$stmt = $pdo->prepare("SELECT * FROM categories");
			$stmt->execute([]);
			while($m = $stmt->fetch()){
				echo "<tr>";
				echo "<td>".$c->getString($m)."</td>";
				echo "<td class='delete'><a href='categories.php?action=del&id=".$m['id']."'>Delete</a>";
				echo "<td class='edit'><a href='categories.php?action=edit&id=".$m['id']."'>Edit</a>";
				echo "</tr>";
			}
		?>
		</table>
	</div>
</body>
</html>