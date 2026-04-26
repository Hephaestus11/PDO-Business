<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Cart Item</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="viewcart.php?account_id=<?php echo $_GET['account_id']; ?>">Return to Cart</a>
	<?php $getCartItemByID = getCartItemByID($pdo, $_GET['cart_id']); ?>
	<h1>Edit Cart Item</h1>
	<form action="core/handleForms.php?cart_id=<?php echo $_GET['cart_id']; ?>&account_id=<?php echo $_GET['account_id']; ?>" method="POST">
		<p>
			<label>Item Name</label>
			<input type="text" name="itemName" value="<?php echo $getCartItemByID['item_name']; ?>">
		</p>
		<p>
			<label>Item Type</label>
			<input type="text" name="itemType" value="<?php echo $getCartItemByID['item_type']; ?>">
		</p>
		<p>
			<label>Quantity</label>
			<input type="number" name="quantity" value="<?php echo $getCartItemByID['quantity']; ?>">
		</p>
		<p>
			<label>Price</label>
			<input type="number" name="price" step="0.01" value="<?php echo $getCartItemByID['price']; ?>">
		</p>
		<p>
			<input type="submit" name="editCartItemBtn" value="Update">
		</p>
	</form>
</body>
</html>
