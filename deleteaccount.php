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
	<title>Delete Account - Guitar Store</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="nav">
		<span>Logged in as: <strong><?php echo $_SESSION['username']; ?></strong></span>
		<a href="index.php">Accounts</a>
		<a href="guitars.php">Guitars</a>
		<a href="otherproducts.php">Other Products</a>
		<a href="core/handleForms.php?logoutAUser=1">Logout</a>
	</div>

	<a href="index.php">Return to Accounts</a>
	<h1>Are you sure you want to delete this account?</h1>
	<?php $getAccountByID = getAccountByID($pdo, $_GET['account_id']); ?>
	<div class="card">
		<h2>Username: <?php echo $getAccountByID['username']; ?></h2>
		<h2>Email: <?php echo $getAccountByID['email']; ?></h2>
		<h2>Date Registered: <?php echo $getAccountByID['date_registered']; ?></h2>
		<p>Added by: <?php echo $getAccountByID['added_by']; ?> | Updated by: <?php echo $getAccountByID['updated_by']; ?></p>

		<div class="actions">
			<form action="core/handleForms.php?account_id=<?php echo $_GET['account_id']; ?>" method="POST">
				<input type="submit" name="deleteAccountBtn" value="Delete">
			</form>
		</div>
	</div>
</body>
</html>
