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
	<title>Guitars - Guitar Store</title>
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

	<h1>Guitar Store - Manage Guitars</h1>

	<!-- add guitar form -->
	<h2>Add New Guitar</h2>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label>Guitar Name</label>
			<input type="text" name="guitarName">
		</p>
		<p>
			<label>Type</label>
			<input type="text" name="guitarType" placeholder="Acoustic, Electric, Bass">
		</p>
		<p>
			<label>Quantity</label>
			<input type="number" name="quantity">
		</p>
		<p>
			<label>Price</label>
			<input type="number" name="price" step="0.01">
		</p>
		<p>
			<input type="submit" name="insertGuitarBtn" value="Add Guitar">
		</p>
	</form>

	<!-- guitar inventory table -->
	<h2>Guitar Inventory</h2>
	<table>
		<tr>
			<th>ID</th>
			<th>Guitar Name</th>
			<th>Type</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Added By</th>
			<th>Updated By</th>
			<th>Date Added</th>
			<th>Action</th>
		</tr>
		<?php $getAllGuitars = getAllGuitars($pdo); ?>
		<?php foreach ($getAllGuitars as $row) { ?>
		<tr>
			<td><?php echo $row['guitar_id']; ?></td>
			<td><?php echo $row['guitar_name']; ?></td>
			<td><?php echo $row['guitar_type']; ?></td>
			<td><?php echo $row['quantity']; ?></td>
			<td><?php echo $row['price']; ?></td>
			<td><?php echo $row['added_by']; ?></td>
			<td><?php echo $row['updated_by']; ?></td>
			<td><?php echo $row['date_added']; ?></td>
			<td>
				<a href="editguitar.php?guitar_id=<?php echo $row['guitar_id']; ?>">Edit</a>
				<a href="deleteguitar.php?guitar_id=<?php echo $row['guitar_id']; ?>">Delete</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>
