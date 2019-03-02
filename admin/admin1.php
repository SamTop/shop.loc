<?php 
require_once('../includes/db.php');
require_once('../classes/admin.class.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
		if ( isset( $_GET['submit'] ) )
		{
			$admin = new Admin($_GET['p_name'], $_GET['p_quantity'], $_GET['p_country'], $_GET['p_price'], $_GET['p_category']);
			if ($admin->validate())
			{
				if(!$admin->check_prod_name())
				{
					$admin->add_cat();
					$admin->add_prod();
				}
			}
			/*if ( mysql_fetch_array(mysql_query("SELECT * FROM products WHERE name = '".$_GET['p_name']."'") ) ) {
				$errors[] = 'The product is already in the list';
			}
			if (!$errors) {
				
				$categories = explode("; ", $_GET['p_category']);
				foreach ($categories as $catgr ) {
					$category = mysql_query("SELECT * FROM categories WHERE name = '".strtolower($catgr)."'" );
					$category = mysql_fetch_array($category);
					if (!$category) {
						mysql_query("INSERT INTO categories (`name`) VALUES ('".strtolower($catgr)."')");
					}
				}

				foreach ($categories as $catgr ) {
					$cat = mysql_query("SELECT id FROM categories WHERE name = '".strtolower($catgr)."'");
					$cat = mysql_fetch_array($cat);
					$cat_ids[] = $cat['id'];
				}

					$sql = "INSERT INTO products (`name`, `price`, `country`, `quantity`) VALUES ('".$_GET['p_name']."', '".$_GET['p_price']."', '".$_GET['p_country']."', '".$_GET['p_quantity']."')";
					mysql_query($sql);
					$prod_id = mysql_insert_id();
				foreach($cat_ids as $id) {
					$sql = "INSERT INTO product_categories (`category_id`, `product_id`) VALUES ('".$id."', '".$prod_id."')";
					mysql_query($sql);
				}

			} else {
				echo array_shift($errors);
			}*/
		}
	?>
	<form action="admin1.php" method="GET">
		Name: <input type="text" name="p_name" value="<?php echo $_GET['p_name'] ?>"><br>
		Quantity: <input type="number" name="p_quantity" value="<?php echo $_GET['p_quantity'] ?>"><br>
		Origin Country: <input type="text" name="p_country" value="<?php echo $_GET['p_country'] ?>"><br>
		Price: <input type="number" name="p_price" value="<?php echo $_GET['p_price'] ?>"><br>
		Category: <input type="text" name="p_category" value="<?php echo $_GET['p_category'] ?>"><br>
		<input type="submit" name="submit" value="submit!"><br>
	</form>
</body>
</html>