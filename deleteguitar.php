<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Delete Guitar</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="guitars.php">Return to Guitars</a>
	<h1>Are you sure you want to delete this guitar?</h1>
	<?php $getGuitarByID = getGuitarByID($pdo, $_GET['guitar_id']); ?>
	<div class="container" style="border-style: solid; height: 350px; padding: 10px;">
		<h2>Guitar Name: <?php echo $getGuitarByID['guitar_name']; ?></h2>
		<h2>Type: <?php echo $getGuitarByID['guitar_type']; ?></h2>
		<h2>Quantity: <?php echo $getGuitarByID['quantity']; ?></h2>
		<h2>Price: <?php echo $getGuitarByID['price']; ?></h2>
		<h2>Date Added: <?php echo $getGuitarByID['date_added']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?guitar_id=<?php echo $_GET['guitar_id']; ?>" method="POST">
				<input type="submit" name="deleteGuitarBtn" value="Delete">
			</form>
		</div>
	</div>
</body>
</html>
