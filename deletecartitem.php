<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Cart Item</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="viewcart.php?account_id=<?php echo $_GET['account_id']; ?>">Return to Cart</a>
	<?php $getCartItemByID = getCartItemByID($pdo, $_GET['cart_id']); ?>
	<h1>Are you sure you want to delete this cart item?</h1>
	<div class="container" style="border-style: solid; height: 350px; padding: 10px;">
		<h2>Item Name: <?php echo $getCartItemByID['item_name']; ?></h2>
		<h2>Item Type: <?php echo $getCartItemByID['item_type']; ?></h2>
		<h2>Quantity: <?php echo $getCartItemByID['quantity']; ?></h2>
		<h2>Price: <?php echo $getCartItemByID['price']; ?></h2>
		<h2>Owner: <?php echo $getCartItemByID['username']; ?></h2>
		<h2>Date Added: <?php echo $getCartItemByID['date_added']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?cart_id=<?php echo $_GET['cart_id']; ?>&account_id=<?php echo $_GET['account_id']; ?>" method="POST">
				<input type="submit" name="deleteCartItemBtn" value="Delete">
			</form>
		</div>
	</div>
</body>
</html>
