<?php 
	require_once('/includes/db.php');
	require_once('classes/product.class.php');
	require_once('classes/category.class.php');

	if (isset($_GET['submit']) && isset($_GET['check'])) {
		if (isset($_SESSION['user'])) {

			foreach ($_GET['check'] as $key) {
				$str .= 'id[]='.$key.'&';
			}
			
			header('Location: /includes/addtocart.php?'.$str);
		} else {
			echo "Log in to make purchases<br>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<title>Document</title>
</head>
<body>
	<?php if(isset($_SESSION['user'])){
		echo "Hello, ".$_SESSION['user']['username']."!";
		echo '<a href="includes/logout.php">Log out</a><br>';
	} else { ?>
	<a href="includes/login.php">Login</a><br>
	<a href="includes/register.php">Register</a>
	<?php } ?>
	<form action="index.php" method="GET">
		<table>
				<tr>
					<th></th>
					<th>Image</th>
					<th>Name</th>
					<th>In Stock</th>
					<th>Price</th>
					<th>Manufacturer</th>
					<th>Category</th>
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
				for ($i=0; $i < count($p) && $i < 20; $i++) { 
					echo "<tr>";
					echo "<td><input type='checkbox' value='".$p[$i]['id']."' name='check[]'>";
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
					echo "</tr>";
				}
			
			?>
		</table>
		<br>
		<input type="submit" name="submit" value="Add to cart">
	</form>
</body>
</html>