<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Guitar</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="guitars.php">Return to Guitars</a>
	<?php $getGuitarByID = getGuitarByID($pdo, $_GET['guitar_id']); ?>
	<h1>Edit Guitar</h1>
	<form action="core/handleForms.php?guitar_id=<?php echo $_GET['guitar_id']; ?>" method="POST">
		<p>
			<label>Guitar Name</label>
			<input type="text" name="guitarName" value="<?php echo $getGuitarByID['guitar_name']; ?>">
		</p>
		<p>
			<label>Type</label>
			<input type="text" name="guitarType" value="<?php echo $getGuitarByID['guitar_type']; ?>">
		</p>
		<p>
			<label>Quantity</label>
			<input type="number" name="quantity" value="<?php echo $getGuitarByID['quantity']; ?>">
		</p>
		<p>
			<label>Price</label>
			<input type="number" name="price" step="0.01" value="<?php echo $getGuitarByID['price']; ?>">
		</p>
		<p>
			<input type="submit" name="editGuitarBtn" value="Update">
		</p>
	</form>
</body>
</html>
