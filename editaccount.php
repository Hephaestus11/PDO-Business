<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Account</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
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
