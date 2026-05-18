<?php
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register - Guitar Store</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<div class="auth-container">
		<h1>Guitar Store</h1>
		<!-- show session messages -->
		<?php if (isset($_SESSION['message'])) { ?>
			<p class="message"><?php echo $_SESSION['message']; ?></p>
		<?php } unset($_SESSION['message']); ?>

		<h2>Register</h2>
		<form action="core/handleForms.php" method="POST">
			<p>
				<label>Username</label>
				<input type="text" name="username">
			</p>
			<p>
				<label>Email</label>
				<input type="text" name="email">
			</p>
			<p>
				<label>Password</label>
				<input type="password" name="password">
			</p>
			<p>
				<label>Confirm Password</label>
				<input type="password" name="confirm_password">
			</p>
			<p>
				<input type="submit" name="registerUserBtn" value="Register">
			</p>
		</form>
		<p>Already have an account? <a href="login.php">Login here</a></p>
	</div>
</body>
</html>
