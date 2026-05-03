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
	<title>Shopping Cart - Guitar Store</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<!-- navigation -->
	<div class="nav">
		<span>Logged in as: <strong><?php echo $_SESSION['username']; ?></strong></span>
		<a href="index.php">Accounts</a>
		<a href="guitars.php">Guitars</a>
		<a href="otherproducts.php">Other Products</a>
		<a href="core/handleForms.php?logoutAUser=1">Logout</a>
	</div>

	<?php $getAccountByID = getAccountByID($pdo, $_GET['account_id']); ?>
	<h1>Shopping Cart of: <?php echo $getAccountByID['username']; ?></h1>

	<!-- add cart item form -->
	<h2>Add Item to Cart</h2>
	<form action="core/handleForms.php?account_id=<?php echo $_GET['account_id']; ?>" method="POST">
		<p>
			<label>Item Name</label>
			<input type="text" name="itemName">
		</p>
		<p>
			<label>Item Type</label>
			<input type="text" name="itemType" placeholder="Guitar, Capo, Strings...">
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
			<input type="submit" name="insertCartItemBtn" value="Add to Cart">
		</p>
	</form>

	<!-- cart items table -->
	<h2>Cart Items</h2>
	<table>
		<tr>
			<th>Cart ID</th>
			<th>Item Name</th>
			<th>Item Type</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Owner</th>
			<th>Added By</th>
			<th>Updated By</th>
			<th>Date Added</th>
			<th>Action</th>
		</tr>
		<?php $getCartByAccount = getCartByAccount($pdo, $_GET['account_id']); ?>
		<?php foreach ($getCartByAccount as $row) { ?>
		<tr>
			<td><?php echo $row['cart_id']; ?></td>
			<td><?php echo $row['item_name']; ?></td>
			<td><?php echo $row['item_type']; ?></td>
			<td><?php echo $row['quantity']; ?></td>
			<td><?php echo $row['price']; ?></td>
			<td><?php echo $row['username']; ?></td>
			<td><?php echo $row['added_by']; ?></td>
			<td><?php echo $row['updated_by']; ?></td>
			<td><?php echo $row['date_added']; ?></td>
			<td>
				<a href="editcartitem.php?cart_id=<?php echo $row['cart_id']; ?>&account_id=<?php echo $_GET['account_id']; ?>">Edit</a>
				<a href="deletecartitem.php?cart_id=<?php echo $row['cart_id']; ?>&account_id=<?php echo $_GET['account_id']; ?>">Delete</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>
