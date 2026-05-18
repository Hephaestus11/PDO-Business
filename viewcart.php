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
		<a href="activitylog.php">Activity Logs</a>
		<a href="search.php">Search</a>
		<a href="core/handleForms.php?logoutAUser=1">Logout</a>
	</div>

	<?php $getAccountByID = getAccountByID($pdo, $_GET['account_id']); ?>
	<h1>Shopping Cart of: <?php echo $getAccountByID['username']; ?></h1>

	<!-- add cart item form -->
	<h2>Add Item to Cart</h2>
	<form action="core/handleForms.php?account_id=<?php echo $_GET['account_id']; ?>" method="POST">
		<p>
			<label>Item Name</label>
			<input type="text" name="itemName" required>
		</p>
		<p>
			<label>Item Type</label>
			<input type="text" name="itemType" placeholder="Guitar, Capo, Strings..." required>
		</p>
		<p>
			<label>Quantity</label>
			<input type="number" name="quantity" id="quantityInput" required oninput="calculateTotal()">
		</p>
		<p>
			<label>Unit Price</label>
			<input type="number" name="price" id="priceInput" step="0.01" required oninput="calculateTotal()">
		</p>
		<p>
			<strong>Total Price: </strong> <span id="totalPriceDisplay">0.00</span>
		</p>
		<p>
			<input type="submit" name="insertCartItemBtn" value="Add to Cart">
		</p>
	</form>

	<script>
		function calculateTotal() {
			let qty = document.getElementById('quantityInput').value;
			let price = document.getElementById('priceInput').value;
			let total = 0;
			if (qty && price) {
				total = parseFloat(qty) * parseFloat(price);
			}
			document.getElementById('totalPriceDisplay').innerText = total.toFixed(2);
		}
	</script>

	<!-- cart items table -->
	<h2>Cart Items</h2>

	<form action="viewcart.php" method="GET" style="margin-bottom: 20px;">
		<input type="hidden" name="account_id" value="<?php echo $_GET['account_id']; ?>">
		<input type="text" name="searchQuery" placeholder="Search cart items...">
		<input type="submit" value="Search">
	</form>

	<table>
		<tr>
			<th>Cart ID</th>
			<th>Item Name</th>
			<th>Item Type</th>
			<th>Quantity</th>
			<th>Unit Price</th>
			<th>Total Price</th>
			<th>Owner</th>
			<th>Added By</th>
			<th>Updated By</th>
			<th>Date Added</th>
			<th>Action</th>
		</tr>
		<?php 
		if (isset($_GET['searchQuery'])) {
			$getCartByAccount = searchCartItems($pdo, $_GET['account_id'], $_GET['searchQuery']);
		} else {
			$getCartByAccount = getCartByAccount($pdo, $_GET['account_id']); 
		}
		?>
		<?php foreach ($getCartByAccount as $row) { 
			$totalPrice = $row['quantity'] * $row['price'];
		?>
		<tr>
			<td><?php echo $row['cart_id']; ?></td>
			<td><?php echo $row['item_name']; ?></td>
			<td><?php echo $row['item_type']; ?></td>
			<td><?php echo $row['quantity']; ?></td>
			<td><?php echo $row['price']; ?></td>
			<td><strong><?php echo number_format($totalPrice, 2); ?></strong></td>
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
