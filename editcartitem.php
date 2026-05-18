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
	<title>Edit Cart Item - Guitar Store</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="nav">
		<span>Logged in as: <strong><?php echo $_SESSION['username']; ?></strong></span>
		<a href="index.php">Accounts</a>
		<a href="guitars.php">Guitars</a>
		<a href="otherproducts.php">Other Products</a>
		<a href="activitylog.php">Activity Logs</a>
		<a href="search.php">Search</a>
		<a href="core/handleForms.php?logoutAUser=1">Logout</a>
	</div>

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
