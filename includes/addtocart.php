<?php
	require_once('/db.php');
	require_once('../classes/product.class.php');
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
	<form action="fill.php">
		<table>
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Quantity</th>
				<th>In Stock</th>
				<th>Price</th>
				<th>Manufacturer</th>
				<th>Category</th>
			</tr>

			<?php
				$id = $_GET['id'];
				$in = '('.implode(",", $id).')';
				$pdo = $GLOBALS['pdo'];
				$stmt = $pdo->query("SELECT * FROM products WHERE id IN ".$in);
				/*$stmt->execute([$in]);*/
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
				for ($i=0; $i < count($p) && $i < 20; $i++) { 
					echo "<tr>";

					echo "<td>";
					foreach ($p[$i]['img'] as $imgg) {
						echo "<img src='..".substr($imgg, 19)."'>";
					}
					
					echo "</td>";
					echo "<td>".$p[$i]['name']."</td>";
					echo '<td><input type="number" name="quantity['.$p[$i]['id'].']" value="1"></td>';
					echo "<td>".$p[$i]['in_stock']."</td>";
					echo "<td>".$p[$i]['price']."</td>";
					echo "<td>".$p[$i]['man']."</td>";
					echo "<td>";

					foreach ($p[$i]['cat'] as $key) {
						echo $key.', ';
					}

					echo "</td>";
					echo "</tr>";
				}
				// echo "<tr>";
				// echo "<td>Total price</td>";
				// echo "<td></td><td></td>";
				// echo "<td>$total_price</td>";
				// echo "<td></td><td></td>";	
				// echo "</tr>";
			?>
		</table>
		<br>
		

		<br>
		<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>