<?php
class Manufacturer
{
	private $name;
	private $address;
	private $phone;
	private $pdo;

	public function createManufacturer($name, $address, $phone) {
		$pdo = $GLOBALS['pdo'];
		if ($this->validate($name, $address, $phone) && $this->checkName($name)) {
			$stmt = $pdo->prepare("INSERT INTO manufacturers (name, address, phone) VALUES (?, ?, ?)");
			$stmt->execute([$name, $address, $phone]);
			echo "Success";
			return true;
		}
		return false;
	}
	public function updateManufacturer($id, $name, $address, $phone) {
		if($this->validate($name, $address, $phone)) {
			$pdo = $GLOBALS['pdo'];
			$stmt = $pdo->prepare("UPDATE manufacturers SET name = ?, address = ?, phone = ? WHERE id = ?");
			$stmt->execute([$name, $address, $phone, $id]);
			echo "success";
		}
	}
	public function deleteManufacturer($id) {
		$pdo = $GLOBALS['pdo'];
		$stmt = $pdo->prepare("DELETE FROM manufacturers WHERE id = ?");
		$stmt->execute([$id]);
	}
	public function validate($name, $address, $phone) {
		if (trim($name) == '') {
			echo 'Enter valid name';
			return false;
		}
		if (trim($address) == '') {
			echo 'Enter valid address';
			return false;
		}
		if (trim($phone) == '') {
			echo 'Enter valid phone number';
			return false;
		}
		return true;
	}
	public function checkName($name) {
		$pdo = $GLOBALS['pdo'];
		$stmt = $pdo->prepare("SELECT * FROM manufacturers WHERE name = ?");
		$stmt->execute([$name]);
		if($stmt->fetch()){
			echo "This manufacturer is already registered";
			return false;
		}
		return true;
	}
	public function getId($name) {
		$pdo = $GLOBALS['pdo'];
		$stmt = $pdo->prepare("SELECT * FROM manufacturers WHERE name = ?");
		$stmt->execute([$name]);
		if($man = $stmt->fetch()) {
			$id = $man['id'];
			return $id;
		} else {
			return false;
		}
	}
}