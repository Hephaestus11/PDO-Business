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
	<title>View Account - Guitar Store</title>
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
	<h1>Account Details</h1>
	<div class="card">
		<h3>Username: <?php echo $getAccountByID['username']; ?></h3>
		<h3>Email: <?php echo $getAccountByID['email']; ?></h3>
		<h3>Date Registered: <?php echo $getAccountByID['date_registered']; ?></h3>
	</div>
</body>
</html>
