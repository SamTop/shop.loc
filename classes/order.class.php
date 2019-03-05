<?php
require_once('../includes/db.php');
class Order {
	public function createOrder($userid, $address) {
		if($this->validateAddress($address)) {
			$pdo = $GLOBALS['pdo'];
			$stmt = $pdo->prepare("INSERT INTO orders (user_id, address) VALUES (?, ?)");
			$stmt->execute([$userid, $address]);
			return true;
		}
		return false;
	}

	public function orderProducts($ord_id, $prod_id, $quant){
		$pdo = $GLOBALS['pdo'];
		$stmt = $pdo->prepare("INSERT INTO order_products (order_id, prod_id, quantity) VALUES (?, ?, ?)");
		$stmt->execute([$ord_id, $prod_id, $quant]);
	}

	public function getOrders(){
		$pdo = $GLOBALS['pdo'];
		$orderr = array();
		$stmt = $pdo->prepare("SELECT * FROM orders");
		$stmt->execute();
		while($ord = $stmt->fetch()) {
			$stm = $pdo->prepare("SELECT * FROM users WHERE id = ?");
			$stm->execute([$ord['user_id']]);
			$user = $stm->fetch();
			$orderr['users'][] = $user['username'];
			$orderr['emails'][] = $user['email'];
			$orderr['addresses'][] = $ord['address'];
			$orderr['dates'][] = $ord['time'];
			$orderr['products'][] = $this->getOrderProducts($ord['id']);
		}
		return $orderr;
	}

	public function getOrderProducts($ord_id) {
		$pdo = $GLOBALS['pdo'];
		$stmt = $pdo->prepare("SELECT * FROM order_products WHERE order_id = ?");
		$stmt->execute([$ord_id]);

		while($ord = $stmt->fetch()) {
			$stm = $pdo->prepare("SELECT * FROM products WHERE id = ?");
			$stm->execute([$ord['prod_id']]);
			$p = $stm->fetch();
			$products[] = $p['name'].' Quantity-'.$ord['quantity'];
		}
		return $products;
	}
	
	public function validateAddress($addr) {
		if (trim($addr) == '') {
			echo "Enter valid address";
			return false;
		}
		return true;
	}
	
}