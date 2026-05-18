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
	<title>Edit Account - Guitar Store</title>
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

	<a href="index.php">Return to Accounts</a>
	<?php $getAccountByID = getAccountByID($pdo, $_GET['account_id']); ?>
	<h1>Edit Account</h1>
	<form action="core/handleForms.php?account_id=<?php echo $_GET['account_id']; ?>" method="POST">
		<p>
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $getAccountByID['username']; ?>">
		</p>
		<p>
			<label>Email</label>
			<input type="text" name="email" value="<?php echo $getAccountByID['email']; ?>">
		</p>
		<p>
			<input type="submit" name="editAccountBtn" value="Update">
		</p>
	</form>
</body>
</html>
