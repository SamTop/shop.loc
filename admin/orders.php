<?php require_once('../includes/db.php'); ?>
<?php require_once('../classes/product.class.php'); ?>
<?php require_once('../classes/order.class.php'); ?>
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
		<table>
			<tr>
				<th>User Name</th>
				<th>E-mail</th>
				<th>Address</th>
				<th>Date</th>
				<th>Products</th>
			</tr>
		<?php
			$stmt = $pdo->prepare("SELECT * FROM orders");
			$stmt->execute([]);

			$o = new Order;
			
			$orders = $o->getOrders();
			for ($i=0; $i < count($orders['users']); $i++) { 
				echo "<tr>";
				echo "<th>".$orders['users'][$i]."</th>";
				echo "<th>".$orders['emails'][$i]."</th>";
				echo "<th>".$orders['addresses'][$i]."</th>";
				echo "<th>".$orders['dates'][$i]."</th>";
				echo "<th>";
					foreach ($orders['products'][$i] as $prod) {
						echo $prod.", ";
					}
					echo $text;
				echo "</th>";
				echo "</tr>";
				$text = "";
			}
		?>
		</table>
	</div>
</body>
</html>