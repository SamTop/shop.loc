<?php

class Product
{
	public function createProduct($name, $manufacturer, $quantity, $price, $category, $file) {
		// Creating product
		$pdo = $GLOBALS['pdo'];
		// Validating and checking images and names
		if ($this->validate($name, $manufacturer, $quantity, $price, $file) && $this->checkName($name) && $this->checkImages($file)) {
			// Inserting into database
			$stmt = $pdo->prepare("INSERT INTO products (`name`, `manufacturer_id`, `in_stock`, `price`) VALUES (?, ?, ?, ?)");
			$stmt->execute([$name, $manufacturer, $quantity, $price]);

			$id = $pdo->lastInsertId();
			// Adding product id and category id into product_categories table
			foreach($category as $cat) {
				$stmt = $pdo->prepare("INSERT INTO product_categories (`prod_id`, `cat_id`) VALUES (?, ?)");
				$stmt->execute([$id, $cat]);
			}
			// Adding selected images
			$this->addImages($file, $id);
			return true;
		}
		return false;
	}
	public function updateProduct($id, $name, $manufacturer, $quantity, $price, $category, $file) {
		if($this->validate($name, $manufacturer, $quantity, $price, $file)) {

			$pdo = $GLOBALS['pdo'];
			$stmt = $pdo->prepare("UPDATE products SET name = ?, manufacturer_id = ?, in_stock = ?, price = ? WHERE id = ?");
			$stmt->execute([$name, $manufacturer, $quantity, $price, $id]);

			foreach($category as $cat) {
				$stmt = $pdo->prepare("UPDATE product_categories SET cat_id = ? WHERE id = ?");
				$stmt->execute([$cat, $id]);
			}

			$stmt = $pdo->prepare("SELECT * FROM images WHERE prod_id = ?");
			$stmt->execute([$id]);
			while($immg = $stmt->fetch()) {
				unlink($immg['dest']);
			}

			$stmt = $pdo->prepare("DELETE FROM images WHERE prod_id = ?");
			$stmt->execute([$id]);

			$this->addImages($file, $id);
			echo "success";
		}
	}
	public function deleteProduct($id) {
		$pdo = $GLOBALS['pdo'];
		$stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
		$stmt->execute([$id]);

		$stmt = $pdo->prepare("SELECT * FROM images WHERE prod_id = ?");
		$stmt->execute([$id]);
		while($immg = $stmt->fetch()) {
			unlink($immg['dest']);
		}

		$stmt = $pdo->prepare("DELETE FROM images WHERE prod_id = ?");
		$stmt->execute([$id]);

		$stmt = $pdo->prepare("DELETE FROM product_categories WHERE prod_id = ?");
		$stmt->execute([$id]);
	}
	public function checkName($name) {
		// Check if name is already registered
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
		// Checking if all fields are properly filled
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
		// Checking image requirements
		// Allowed formats
		$allowed = array('jpg', 'jpeg', 'png', 'gif');

		for ($i = 0; $i < count($file['name']); $i++) { 
			// Setting file properties to variables
			$fileName = $file['name'][$i];
			$fileTmpName = $file['tmp_name'][$i];
			$fileSize = $file['size'][$i];
			$fileError = $file['error'][$i];
			$fileType = $file['type'][$i];

			$fileExt = explode('.', $fileName);
			$fileActualExt = strtolower(end($fileExt));

			// Checking format type
			if(in_array($fileActualExt, $allowed)) {
				// Checking file error message
				if ($fileError === 0) {
					// Checking file size
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
		// Add images to images table
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
						$fileDestination = $_SERVER['DOCUMENT_ROOT']. "/uploads/".$fileNameNew;

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
	public function getProdFromId($id) {
		$pdo = $GLOBALS['pdo'];
		$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
		$stmt->execute([$id]);
		return $stmt->fetch();
	}

}


?>