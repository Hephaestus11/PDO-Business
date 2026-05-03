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
	<title>Delete Guitar - Guitar Store</title>
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

	<a href="guitars.php">Return to Guitars</a>
	<h1>Are you sure you want to delete this guitar?</h1>
	<?php $getGuitarByID = getGuitarByID($pdo, $_GET['guitar_id']); ?>
	<div class="card">
		<h2>Guitar Name: <?php echo $getGuitarByID['guitar_name']; ?></h2>
		<h2>Type: <?php echo $getGuitarByID['guitar_type']; ?></h2>
		<h2>Quantity: <?php echo $getGuitarByID['quantity']; ?></h2>
		<h2>Price: <?php echo $getGuitarByID['price']; ?></h2>
		<h2>Date Added: <?php echo $getGuitarByID['date_added']; ?></h2>
		<p>Added by: <?php echo $getGuitarByID['added_by']; ?> | Updated by: <?php echo $getGuitarByID['updated_by']; ?></p>

		<div class="actions">
			<form action="core/handleForms.php?guitar_id=<?php echo $_GET['guitar_id']; ?>" method="POST">
				<input type="submit" name="deleteGuitarBtn" value="Delete">
			</form>
		</div>
	</div>
</body>
</html>
