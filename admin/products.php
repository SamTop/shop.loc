<?php
	require_once('../includes/db.php'); 
	require_once('../classes/product.class.php');
	require_once('../classes/category.class.php');

$prod = new Product;

if ($_GET['action'] == 'edit'){
	header("Location: editproduct.php?id=".$_GET['id']);
}
if ($_GET['action'] == 'del') {
	echo $prod->deleteProduct($_GET['id']);
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
		<a class="add" href="addproduct.php">Add</a><br><br>
		<table>
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>In Stock</th>
				<th>Price</th>
				<th>Manufacturer</th>
				<th>Category</th>
				<th></th>
				<th></th>
			</tr>
		<?php
			$stmt = $pdo->prepare("SELECT * FROM products");
			$stmt->execute([]);
			// Getting products into $p array
			while($tmp = $stmt->fetch()) {
				$p[] = $tmp;
			}
			$cc = new Category;
			// Getting category, manufacturer name, images into $p array
			for ($i=0; $i < count($p); $i++) {
				$stmt = $pdo->prepare("SELECT * FROM product_categories WHERE prod_id = ?");
				$stmt->execute([$p[$i]['id']]);

				while($a = $stmt->fetch()) {
					$st = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
					$st->execute([$a['cat_id']]);

					$p[$i]['cat'][] = $cc->getString($st->fetch());
				}
				$ct = $pdo->prepare("SELECT * FROM images WHERE prod_id = ?");
				$ct->execute([$p[$i]['id']]);

				while($img = $ct->fetch()) {
					$p[$i]['img'][] = $img['dest'];
				}
				

				$stm = $pdo->prepare("SELECT * FROM manufacturers WHERE id = ?");
				$stm->execute([$p[$i]['manufacturer_id']]);
				$m = $stm->fetch();
				$p[$i]['man'] = $m['name'];
			}

			// Displaying tables
			for ($i=0; $i < count($p); $i++) { 
				echo "<tr>";
				echo "<td>";

				foreach ($p[$i]['img'] as $imgg) {
					echo "<img src='..".substr($imgg, 19)."'>";
				}

				echo "</td>";
				echo "<td>".$p[$i]['name']."</td>";
				echo "<td>".$p[$i]['in_stock']."</td>";
				echo "<td>".$p[$i]['price']."</td>";
				echo "<td>".$p[$i]['man']."</td>";
				echo "<td>";
				foreach ($p[$i]['cat'] as $key) {
					echo $key.', ';
				}
				echo "</td>";
				echo "<td class='delete'><a href='products.php?action=del&id=".$p[$i]['id']."&filename=".$p[$i]['img']."'>Delete</a>";
				echo "<td class='edit'><a href='products.php?action=edit&id=".$p[$i]['id']."'>Edit</a>";
				echo "</td>";
				echo "</tr>";
			}
		?>
		</table>
	</div>
</body>
</html>