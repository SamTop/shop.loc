<?php

class Product
{


	public function createProduct($name, $manufacturer, $quantity, $price, $category, $file) {
		$pdo = $GLOBALS['pdo'];
		if ($this->validate($name, $manufacturer, $quantity, $price, $file) && $this->checkName($name) && $this->checkImages($file)) {
			$stmt = $pdo->prepare("INSERT INTO products (`name`, `manufacturer_id`, `in_stock`, `price`) VALUES (?, ?, ?, ?)");
			$stmt->execute([$name, $manufacturer, $quantity, $price]);

			$id = $pdo->lastInsertId();
			foreach($category as $cat) {
				$stmt = $pdo->prepare("INSERT INTO product_categories (`prod_id`, `cat_id`) VALUES (?, ?)");
				$stmt->execute([$id, $cat]);
			}
			$this->addImages($file, $id);
			return true;
		}
		return false;
	}
	public function updateProduct($name, $manufacturer, $quantity, $price) {

	}
	public function deleteProduct($id) {

	}
	public function checkName($name) {
		$pdo = $GLOBALS['pdo'];
		$stmt = $pdo->prepare("SELECT * FROM products WHERE name = ?");
		$stmt->execute([$name]);
		if ($stmt->fetch()) {
			echo "The name is already registered";
			return false;
		}
		return true;
	}
	public function validate($name, $manufacturer, $quantity, $price, $file) {
		if (trim($name) == '') {
			echo "Enter valid name";
			return false;
		}
		if (trim($price) == '') {
			echo "Enter valid price";
			return false;
		}
		if (trim($quantity) == '') {
			echo "Enter valid quantity";
			return false;
		}
		if (trim($file['name'] == '')) {
			/*var_dump($file);*/
			echo "Choose image";
			return false;
		}
		return true;
	}
	public function getImages($id) {

	}
	public function getId($name) {

	}
	public function checkImages($file) {
		$allowed = array('jpg', 'jpeg', 'png', 'gif');
		for ($i = 0; $i < count($file['name']); $i++) { 
			$fileName = $file['name'][$i];
			$fileTmpName = $file['tmp_name'][$i];
			$fileSize = $file['size'][$i];
			$fileError = $file['error'][$i];
			$fileType = $file['type'][$i];

			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));

			if(in_array($fileActualExt, $allowed)) {
				if ($fileError === 0) {
					if($fileSize < 10000000) {
						return true;
					} else {
						echo "Too big file!";
						return false;
					}
				} else {
					echo "Error uploading file!";
					return false;
				}
			} else {
				echo "Wrong type!";
				return false;
			}
		}
		return false;
	}
	public function addImages($file, $prod_id) {
		$pdo = $GLOBALS['pdo'];
		$allowed = array('jpg', 'jpeg', 'png', 'gif');

		for ($i = 0; $i < count($file['name']); $i++) { 
			$fileName = $file['name'][$i];
			$fileTmpName = $file['tmp_name'][$i];
			$fileSize = $file['size'][$i];
			$fileError = $file['error'][$i];
			$fileType = $file['type'][$i];

			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));

			if(in_array($fileActualExt, $allowed)) {
				if ($fileError === 0) {
					if($fileSize < 10000000) {
						$fileNameNew = uniqid('', true).'.'.$fileActualExt;
						$fileDestination = $_SERVER['DOCUMENT_ROOT']. "\uploads\\".$fileNameNew;

						if(move_uploaded_file($fileTmpName, $fileDestination)){
							$stmt = $pdo->prepare("INSERT INTO images (`prod_id`, `dest`) VALUES (?, ?)");
							$stmt->execute([$prod_id, $fileDestination]);
						} else {
							echo "Error";
							return false;
						}
					} else {
						echo "Too big file!";
						return false;
					}
				} else {
					echo "Error uploading file!";
					return false;
				}
			} else {
				echo "Wrong type!";
				return false;
			}
		}
		return true;
	}

}


?>