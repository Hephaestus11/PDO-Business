<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Account</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="index.php">Return to Accounts</a>
	<h1>Are you sure you want to delete this account?</h1>
	<?php $getAccountByID = getAccountByID($pdo, $_GET['account_id']); ?>
	<div class="container" style="border-style: solid; height: 300px; padding: 10px;">
		<h2>Username: <?php echo $getAccountByID['username']; ?></h2>
		<h2>Email: <?php echo $getAccountByID['email']; ?></h2>
		<h2>Date Registered: <?php echo $getAccountByID['date_registered']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?account_id=<?php echo $_GET['account_id']; ?>" method="POST">
				<input type="submit" name="deleteAccountBtn" value="Delete">
			</form>
		</div>
	</div>
</body>
</html>
