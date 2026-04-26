<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Guitar Store</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Guitar Store - Account Registration</h1>
	<p>
		<a href="index.php">Accounts</a>
		<a href="guitars.php">Guitars</a>
		<a href="otherproducts.php">Other Products</a>
	</p>

	<h2>Register New Account</h2>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label>Username</label>
			<input type="text" name="username">
		</p>
		<p>
			<label>Email</label>
			<input type="text" name="email">
		</p>
		<p>
			<label>Password</label>
			<input type="password" name="password">
		</p>
		<p>
			<input type="submit" name="insertAccountBtn" value="Register">
		</p>
	</form>

	<h2>Registered Accounts</h2>
	<?php $getAllAccounts = getAllAccounts($pdo); ?>
	<?php foreach ($getAllAccounts as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 250px; margin-top: 20px; padding: 10px;">
		<h3>Username: <?php echo $row['username']; ?></h3>
		<h3>Email: <?php echo $row['email']; ?></h3>
		<h3>Date Registered: <?php echo $row['date_registered']; ?></h3>

		<div style="float: right; margin-right: 20px;">
			<a href="viewcart.php?account_id=<?php echo $row['account_id']; ?>">View Cart</a>
			<a href="editaccount.php?account_id=<?php echo $row['account_id']; ?>">Edit</a>
			<a href="deleteaccount.php?account_id=<?php echo $row['account_id']; ?>">Delete</a>
		</div>
	</div>
	<?php } ?>
</body>
</html>
