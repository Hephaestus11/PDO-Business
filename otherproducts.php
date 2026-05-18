<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Other Products - Guitar Store</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<!-- navigation -->
	<div class="nav">
		<span>Logged in as: <strong><?php echo $_SESSION['username']; ?></strong></span>
		<a href="index.php">Accounts</a>
		<a href="guitars.php">Guitars</a>
		<a href="otherproducts.php">Other Products</a>
		<a href="activitylog.php">Activity Logs</a>
		<a href="search.php">Search</a>
		<a href="core/handleForms.php?logoutAUser=1">Logout</a>
	</div>

	<h1>Guitar Store - Other Products</h1>

	<!-- add product form -->
	<h2>Add New Product</h2>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label>Product Name</label>
			<input type="text" name="productName">
		</p>
		<p>
			<label>Category</label>
			<input type="text" name="category" placeholder="Capo, Strings, Amplifier...">
		</p>
		<p>
			<label>Quantity</label>
			<input type="number" name="quantity">
		</p>
		<p>
			<label>Price</label>
			<input type="number" name="price" step="0.01">
		</p>
		<p>
			<input type="submit" name="insertOtherProductBtn" value="Add Product">
		</p>
	</form>

	<!-- other products table -->
	<h2>Other Products Inventory</h2>
	<table>
		<tr>
			<th>ID</th>
			<th>Product Name</th>
			<th>Category</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Added By</th>
			<th>Updated By</th>
			<th>Date Added</th>
			<th>Action</th>
		</tr>
		<?php $getAllOtherProducts = getAllOtherProducts($pdo); ?>
		<?php foreach ($getAllOtherProducts as $row) { ?>
		<tr>
			<td><?php echo $row['product_id']; ?></td>
			<td><?php echo $row['product_name']; ?></td>
			<td><?php echo $row['category']; ?></td>
			<td><?php echo $row['quantity']; ?></td>
			<td><?php echo $row['price']; ?></td>
			<td><?php echo $row['added_by']; ?></td>
			<td><?php echo $row['updated_by']; ?></td>
			<td><?php echo $row['date_added']; ?></td>
			<td>
				<a href="editotherproduct.php?product_id=<?php echo $row['product_id']; ?>">Edit</a>
				<a href="deleteotherproduct.php?product_id=<?php echo $row['product_id']; ?>">Delete</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>
