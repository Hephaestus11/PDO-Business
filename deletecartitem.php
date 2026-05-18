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
	<title>Delete Cart Item - Guitar Store</title>
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
	<h1>Are you sure you want to delete this cart item?</h1>
	<div class="card">
		<h2>Item Name: <?php echo $getCartItemByID['item_name']; ?></h2>
		<h2>Item Type: <?php echo $getCartItemByID['item_type']; ?></h2>
		<h2>Quantity: <?php echo $getCartItemByID['quantity']; ?></h2>
		<h2>Price: <?php echo $getCartItemByID['price']; ?></h2>
		<h2>Owner: <?php echo $getCartItemByID['username']; ?></h2>
		<h2>Date Added: <?php echo $getCartItemByID['date_added']; ?></h2>
		<p>Added by: <?php echo $getCartItemByID['added_by']; ?> | Updated by: <?php echo $getCartItemByID['updated_by']; ?></p>

		<div class="actions">
			<form action="core/handleForms.php?cart_id=<?php echo $_GET['cart_id']; ?>&account_id=<?php echo $_GET['account_id']; ?>" method="POST">
				<input type="submit" name="deleteCartItemBtn" value="Delete">
			</form>
		</div>
	</div>
</body>
</html>
