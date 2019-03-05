<?php
	require_once('/db.php');
	require_once('../classes/order.class.php');
	
	if (!isset($_SESSION['user'])) {
		header("Location: /");
	}


	$ord = new Order;
	
	if($ord->createOrder($_SESSION['user']['id'], $_GET['address'])) {
		$id = $pdo->lastInsertId();
		
		foreach ($_SESSION['quantity'] as $prod_id => $quant) {
			$ord->orderProducts($id, $prod_id, $quant);
		}
		header("Location: /");
	}

?>