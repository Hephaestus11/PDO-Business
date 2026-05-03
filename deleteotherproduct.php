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
	<title>Delete Product - Guitar Store</title>
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
	<h1>Are you sure you want to delete this product?</h1>
	<?php $getOtherProductByID = getOtherProductByID($pdo, $_GET['product_id']); ?>
	<div class="card">
		<h2>Product Name: <?php echo $getOtherProductByID['product_name']; ?></h2>
		<h2>Category: <?php echo $getOtherProductByID['category']; ?></h2>
		<h2>Quantity: <?php echo $getOtherProductByID['quantity']; ?></h2>
		<h2>Price: <?php echo $getOtherProductByID['price']; ?></h2>
		<h2>Date Added: <?php echo $getOtherProductByID['date_added']; ?></h2>
		<p>Added by: <?php echo $getOtherProductByID['added_by']; ?> | Updated by: <?php echo $getOtherProductByID['updated_by']; ?></p>

		<div class="actions">
			<form action="core/handleForms.php?product_id=<?php echo $_GET['product_id']; ?>" method="POST">
				<input type="submit" name="deleteOtherProductBtn" value="Delete">
			</form>
		</div>
	</div>
</body>
</html>
