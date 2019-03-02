<?php 
require_once('../includes/db.php'); 
require_once('../classes/manufacturer.class.php');
$man = new Manufacturer;
if ($_GET['action'] == 'edit'){
	header("Location: editmanufacturer.php?id=".$_GET['manId']);
}
if ($_GET['action'] == 'del') {
	echo $man->deleteManufacturer($_GET['manId']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<title>Document</title>
</head>
<body>
	<div class="menu">
		<ul>
			<li><a href="products.php">Products</a></li>
			<li><a href="categories.php">Categories</a></li>
			<li><a href="manufacturers.php">Manufacturers</a></li>
			<li><a href="orders.php">Orders</a></li>
		</ul>
	</div>
	<div class="main">
		<a class="add" href="addmanufacturer.php">Add</a><br>
		<table>
			<tr>
				<th>Name</th>
				<th>Address</th>
				<th>Phone</th>
			</tr>
		<?php
			$stmt = $pdo->prepare("SELECT * FROM manufacturers");
			$stmt->execute([]);
			while($m = $stmt->fetch()){
				echo "<tr>";
				echo "<td>".$m['name']."</td>";
				echo "<td>".$m['address']."</td>";
				echo "<td>".$m['phone']."</td>";
				echo "<td class='delete'><a href='manufacturers.php?action=del&manId=".$m['id']."'>Delete</a>";
				echo "<td class='edit'><a href='manufacturers.php?action=edit&manId=".$m['id']."'>Edit</a>";
				echo "</tr>";
			}
		?>
		</table>
	</div>
</body>
</html>