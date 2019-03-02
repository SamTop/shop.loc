<?php
class Admin
{
	private $name;
	private $quantity;
	private $country;
	private $price;
	public $categories;
	private $cat_str;

	function __construct($name, $quantity, $country, $price, $category) {
		$this->name = $name;
		$this->quantity = $quantity;
		$this->country = $country;
		$this->price = $price;
		$this->cat_str = $category;
		$this->categories = explode("; ", $category);
		$this->pdo = $GLOBALS['pdo'];
	}

	function validate() {
		if ( trim( $this->name ) == '' )
		{
			echo 'Enter product name';
			return false;
		}
		if ( trim( $this->quantity ) == '' || $this->quantity < 0 )
		{
			echo 'Enter valid quantity';
			return false;
		}
		if ( trim( $this->country ) == '' )
		{
			echo 'Enter origin country';
			return false;
		}
		if ( trim( $this->price ) == '' || $this->price < 0 )
		{
			echo 'Enter product price';
			return false;
		}
		if ( trim( $this->cat_str ) == '' )
		{
			echo 'Enter product category';
			return false;
		}
		return true;
	}
	function add_cat() 	{
		foreach($this->categories as $cat)
		{
			$stmt = $this->pdo->prepare("SELECT * FROM categories WHERE name = ?");
			$stmt->execute([strtolower($cat)]);
			$found_cats[] = $stmt->fetch();
			var_dump(trim($cat));
			if (!$found_cats || trim($cat) == '') {
				$sql = $this->pdo->prepare("INSERT INTO categories (`name`) VALUES (?)");
				$sql->execute([strtolower($cat)]);
			}
		}
	}
	function add_prod() {
		foreach ($this->categories as $cat) {
			$c = $this->pdo->prepare("SELECT id FROM categories WHERE name = ?");
			$c->execute([strtolower($cat)]);
			$ctg = $c->fetch();
			$cat_ids[] = $ctg['id'];
		}
		$sql = $this->pdo->prepare("INSERT INTO products (`name`, `price`, `country`, `quantity`) VALUES (?,?,?,?)");
		$sql->execute([strtolower($this->name), $this->price, strtolower($this->country), $this->quantity]);
		$sqll = $sql->fetch();
		$last_id = $this->pdo->lastInsertId();
		foreach($cat_ids as $id)
		{
			$this->pdo->prepare("INSERT INTO product_categories (`category_id`, `product_id`) VALUES (?, ?)")->execute([$id, $last_id]);
		}
	}
	function check_prod_name() {
		$res = $this->pdo->prepare("SELECT * FROM products WHERE name = ?");
		$res->execute([strtolower($this->name)]);
		$result = $res->fetch();
		if ($result)
		{
			echo "A product with such name already exists.";
			return true;
		}
		else
		{	
			return false;
		}
	}
}