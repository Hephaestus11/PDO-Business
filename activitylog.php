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
	<title>Guitar Store - Activity Logs</title>
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

	<!-- session messages -->
	<?php if (isset($_SESSION['message'])) { ?>
		<p class="message"><?php echo $_SESSION['message']; ?></p>
	<?php } unset($_SESSION['message']); ?>

	<h1>Guitar Store - Activity Logs</h1>

	<!-- list of all activity logs -->
	<h2>System Activity Logs</h2>
	<?php $getAllActivityLogs = getAllActivityLogs($pdo); ?>
	
	<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: left; margin-top: 20px;">
		<tr>
			<th>Activity ID</th>
			<th>Operation</th>
			<th>Action Made In</th>
			<th>Performed By</th>
			<th>Date Added</th>
		</tr>
		<?php foreach ($getAllActivityLogs as $row) { ?>
		<tr>
			<td><?php echo $row['activity_id']; ?></td>
			<td><?php echo $row['operation']; ?></td>
			<td><?php echo $row['location_name']; ?></td>
			<td><?php echo $row['username']; ?></td>
			<td><?php echo $row['date_added']; ?></td>
		</tr>
		<?php } ?>
	</table>

</body>
</html>
