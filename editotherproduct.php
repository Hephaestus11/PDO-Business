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
	<title>Edit Product - Guitar Store</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="nav">
		<span>Logged in as: <strong><?php echo $_SESSION['username']; ?></strong></span>
		<a href="index.php">Accounts</a>
		<a href="guitars.php">Guitars</a>
		<a href="otherproducts.php">Other Products</a>
		<a href="core/handleForms.php?logoutAUser=1">Logout</a>
	</div>

	<a href="otherproducts.php">Return to Other Products</a>
	<?php $getOtherProductByID = getOtherProductByID($pdo, $_GET['product_id']); ?>
	<h1>Edit Product</h1>
	<form action="core/handleForms.php?product_id=<?php echo $_GET['product_id']; ?>" method="POST">
		<p>
			<label>Product Name</label>
			<input type="text" name="productName" value="<?php echo $getOtherProductByID['product_name']; ?>">
		</p>
		<p>
			<label>Category</label>
			<input type="text" name="category" value="<?php echo $getOtherProductByID['category']; ?>">
		</p>
		<p>
			<label>Quantity</label>
			<input type="number" name="quantity" value="<?php echo $getOtherProductByID['quantity']; ?>">
		</p>
		<p>
			<label>Price</label>
			<input type="number" name="price" step="0.01" value="<?php echo $getOtherProductByID['price']; ?>">
		</p>
		<p>
			<input type="submit" name="editOtherProductBtn" value="Update">
		</p>
	</form>
</body>
</html>
