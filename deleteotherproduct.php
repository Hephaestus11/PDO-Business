<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Other Product</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="otherproducts.php">Return to Other Products</a>
	<h1>Are you sure you want to delete this product?</h1>
	<?php $getOtherProductByID = getOtherProductByID($pdo, $_GET['product_id']); ?>
	<div class="container" style="border-style: solid; height: 350px; padding: 10px;">
		<h2>Product Name: <?php echo $getOtherProductByID['product_name']; ?></h2>
		<h2>Category: <?php echo $getOtherProductByID['category']; ?></h2>
		<h2>Quantity: <?php echo $getOtherProductByID['quantity']; ?></h2>
		<h2>Price: <?php echo $getOtherProductByID['price']; ?></h2>
		<h2>Date Added: <?php echo $getOtherProductByID['date_added']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?product_id=<?php echo $_GET['product_id']; ?>" method="POST">
				<input type="submit" name="deleteOtherProductBtn" value="Delete">
			</form>
		</div>
	</div>
</body>
</html>
