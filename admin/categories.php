<?php require_once('../includes/db.php'); ?>
<?php require_once('../classes/category.class.php'); ?>
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
			

			$c = new Category;
			$stmt = $pdo->prepare("SELECT * FROM categories");
			$stmt->execute([]);
			while($m = $stmt->fetch()){
				echo "<tr>";
				echo "<td>".$c->getString($m)."</td>";
				echo "</tr>";
			}
		?>
		</table>
	</div>
</body>
</html>