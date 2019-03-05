<?php
	require_once('/db.php');
	require_once('../classes/product.class.php');
	require_once('../classes/category.class.php');
	require_once('../classes/order.class.php');
	if (!isset($_SESSION['user'])) {
		header("Location: /");
	}
	/*var_dump($_GET);*/
	$pdo = $GLOBALS['pdo'];
	foreach ($_GET['quantity'] as $key => $val) {
		$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
		$stmt->execute([$key]);
		$prod = $stmt->fetch();

		$price = $prod['price'] * $val;
		$total += $price;
	}
	$_SESSION['quantity'] = $_GET['quantity'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<title>Document</title>
</head>
<body>
	<p>Total price : <?php echo $total; ?></p>
	<form action="order.php" method="GET">
		<input type="text" name="address"> : Your address <br><br>
		<input type="submit" name="submit">
	</form>
</body>
</html>