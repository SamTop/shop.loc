<?php
	require_once('../includes/db.php'); 
	require_once('../classes/product.class.php');
	require_once('../classes/category.class.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<title>Document</title>
</head>
<body>
	<?php
		if(!isset($_POST['submit'])) {
			$_SESSION['id'] = $_GET['id'];
			$id = $_SESSION['id'];
		}
		if (isset($_POST['submit']))
		{
			$p = new Product;
			if($p->updateProduct($_SESSION['id'], strtolower($_POST['name']), $_POST['manufacturer'], $_POST['in_stock'], $_POST['price'], $_POST['category'], $_FILES['img'])) {
				$_POST = null;
			}
		}
	?>
	<form action="editproduct.php" method="POST" enctype='multipart/form-data' >
		<input type="text" name="name" value="<?php echo $_POST['name'] ?>"> : Name <br>
		<select name="manufacturer">
			<?php 
				// Show manufacturers
				$stmt = $pdo->prepare("SELECT * FROM manufacturers");
				$stmt->execute([]);
				while ($man = $stmt->fetch()) {
					echo "<option value='".$man['id']."'>";
					echo $man['name'];
					echo "</option>";
				}
			?>
		</select> : Manufacturer<br>
		<select name="category[]" multiple>
			<?php 
				// Show categories
				$c = new Category;
				$stmt = $pdo->prepare("SELECT * FROM categories");
				$stmt->execute([]);
				while ($cat = $stmt->fetch()) {
					echo "<option value='".$cat['id']."'>";
					echo $c->getString($cat);
					echo "</option>";
				}
			?>
		</select> : Category<br>
		<input type="number" name="price" value="<?php echo $_POST['price']; ?>"> : Price <br>
		<input type="number" name="in_stock" value="<?php echo $_POST['in_stock']; ?>"> : Quantity <br>
		<input type="file" name="img[]" multiple="multiple"><br>
		<input type="submit" name="submit" value="Edit">
	</form>
</body>
</html>