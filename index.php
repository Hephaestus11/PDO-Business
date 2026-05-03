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
	<title>Guitar Store</title>
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

	<!-- session messages -->
	<?php if (isset($_SESSION['message'])) { ?>
		<p class="message"><?php echo $_SESSION['message']; ?></p>
	<?php } unset($_SESSION['message']); ?>

	<h1>Guitar Store - Accounts</h1>

	<!-- list of all accounts -->
	<h2>Registered Accounts</h2>
	<?php $getAllAccounts = getAllAccounts($pdo); ?>
	<?php foreach ($getAllAccounts as $row) { ?>
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
</body>
</html>
