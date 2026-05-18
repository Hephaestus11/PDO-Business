<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

// redirect to login if no session
if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Global Search - Guitar Store</title>
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

	<!-- session messages -->
	<?php if (isset($_SESSION['message'])) { ?>
		<p class="message"><?php echo $_SESSION['message']; ?></p>
	<?php } unset($_SESSION['message']); ?>

	<h1>Global Search (Accounts & Cart Items)</h1>

	<form action="search.php" method="GET" style="margin-bottom: 20px;">
		<input type="text" name="searchQuery" placeholder="Search accounts or items..." required>
		<input type="submit" value="Search">
	</form>

	<?php if (isset($_GET['searchQuery'])) { ?>
		<h2>Accounts Matching "<?php echo htmlspecialchars($_GET['searchQuery']); ?>"</h2>
		<?php $matchingAccounts = searchAccounts($pdo, $_GET['searchQuery']); ?>
		
		<?php if (empty($matchingAccounts)) { ?>
			<p>No accounts found.</p>
		<?php } else { ?>
			<?php foreach ($matchingAccounts as $row) { ?>
			<div class="card">
				<h3>Username: <?php echo $row['username']; ?></h3>
				<h3>Email: <?php echo $row['email']; ?></h3>
				<h3>Date Registered: <?php echo $row['date_registered']; ?></h3>
				<p>Added by: <?php echo $row['added_by']; ?> | Updated by: <?php echo $row['updated_by']; ?></p>
				<div class="actions">
					<a href="viewcart.php?account_id=<?php echo $row['account_id']; ?>">View Cart</a>
					<a href="editaccount.php?account_id=<?php echo $row['account_id']; ?>">Edit</a>
					<a href="deleteaccount.php?account_id=<?php echo $row['account_id']; ?>">Delete</a>
				</div>
			</div>
			<?php } ?>
		<?php } ?>

		<hr style="margin: 40px 0;">

		<h2>Shopping Cart Items Matching "<?php echo htmlspecialchars($_GET['searchQuery']); ?>"</h2>
		<?php $matchingCartItems = searchAllCartItems($pdo, $_GET['searchQuery']); ?>

		<?php if (empty($matchingCartItems)) { ?>
			<p>No cart items found.</p>
		<?php } else { ?>
			<table>
				<tr>
					<th>Cart ID</th>
					<th>Item Name</th>
					<th>Item Type</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Owner (Account)</th>
					<th>Added By</th>
					<th>Updated By</th>
					<th>Date Added</th>
					<th>Action</th>
				</tr>
				<?php foreach ($matchingCartItems as $row) { ?>
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
						<a href="viewcart.php?account_id=<?php echo $row['account_id']; ?>">Go to Cart</a>
					</td>
				</tr>
				<?php } ?>
			</table>
		<?php } ?>

	<?php } else { ?>
		<p>Please enter a search term above to find accounts or shopping cart items.</p>
	<?php } ?>

</body>
</html>
