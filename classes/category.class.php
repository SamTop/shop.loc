<?php
class Category
{
	public function createCategory($name, $parent_name) {
		$pdo = $GLOBALS['pdo'];
		if ($this->validate($name) && $this->checkName($name, $parent_name)) {
			if ($parent_name == '') {
				$stmt = $pdo->prepare("INSERT INTO categories (`name`) VALUES (?)");
				$stmt->execute([$name]);
				echo "Successfully registered!";
				return true;
			} else {
				if($id = $this->getId($parent_name)){
					$stmt = $pdo->prepare("INSERT INTO categories (`name`, `parent_id`) VALUES (?, ?)");
					$stmt->execute([$name, $id]);
					echo "Successfully registered!";
					return true;
				} else {
					echo "No such parent category";
					return false;
				}
			}
		}
		return false;
	}
	public function updateCategory($id, $name, $parent_id) {

	}
	public function deleteCategory() {

	}
	public function validate($name) {
		if (trim($name) == '') {
			echo "Enter valid name";
			return false;
		}
		return true;
	}
	public function checkName($name, $parent_name) {
		
		$pdo = $GLOBALS['pdo'];

		if ($parent_name == '') {
			$id = 0;
		} else {
			$id = $this->getId($parent_name);
		}
		if ($id === false) {
			echo "No such parent";
			return false;
		}
		$stmt = $pdo->prepare("SELECT * FROM categories WHERE name = ? AND parent_id = ?");
		$stmt->execute([$name, $id]);
		$a = $stmt->fetch();
		if ($a) {
			echo "This category is already registered";
			return false;
		}
		return true;
	}
	public function getId($parent_name) {
		$pdo = $GLOBALS['pdo'];
		$stmt = $pdo->prepare("SELECT * FROM categories WHERE name = ?");
		$stmt->execute([$parent_name]);
		if($parent = $stmt->fetch()){
			$id = $parent['id'];
			return $id;	
		} else {
			return false;
		}
	}
	public function getParentId($parent_name) {
		$pdo = $GLOBALS['pdo'];
		$stmt = $pdo->prepare("SELECT * FROM categories WHERE name = ?");
		$stmt->execute([$parent_name]);
		if($parent = $stmt->fetch()){
			$id = $parent['id'];
			return $id;	
		} else {
			echo "No parent found";
			return false;
		}
	}
	public function showAll() {

	}
	public function getString($cat) {
		$pdo = $GLOBALS['pdo'];
		$fullName = $cat['name'];
		while(true)
		{
			$id = $cat['parent_id'];
			/*echo "$id";*/
			if($id != 0) {
				
				$stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
				$stmt->execute([$id]);
				
				$cat = $stmt->fetch();
				/*var_dump($cat);*/
				$fullName = $cat['name']."/".$fullName;
			}
			if ($id == 0) {
				break;
			}
		}
		return $fullName;
	}
}