<?php 

require_once 'dbConfig.php';
require_once 'models.php';
require_once 'validate.php'; // import validate.php for sanitizeInput() and validatePassword()


// ---- User Handlers (Register/Login/Logout) ----

if (isset($_POST['registerUserBtn'])) {
	// sanitize inputs to prevent XSS
	$username = sanitizeInput($_POST['username']);
	$email = sanitizeInput($_POST['email']);
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	if (!empty($username) && !empty($email) && !empty($password) && !empty($confirm_password)) {
		// check if passwords match
		if ($password == $confirm_password) {
			// validate password strength
			if (validatePassword($password)) {
				$insertQuery = insertNewUser($pdo, $username, $email, sha1($password));
				if ($insertQuery) {
					header("Location: ../login.php");
				} else {
					header("Location: ../register.php");
				}
			} else {
				$_SESSION['message'] = "Password should be more than 8 characters and should contain both uppercase, lowercase, and numbers";
				header("Location: ../register.php");
			}
		} else {
			$_SESSION['message'] = "Please check if both passwords are equal!";
			header("Location: ../register.php");
		}
	} else {
		$_SESSION['message'] = "Please fill in all fields for registration!";
		header("Location: ../register.php");
	}
}

if (isset($_POST['loginUserBtn'])) {
	// sanitize username input to prevent XSS
	$username = sanitizeInput($_POST['username']);
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {
		$loginQuery = loginUser($pdo, $username, $password);
		if ($loginQuery) {
			header("Location: ../index.php");
		} else {
			header("Location: ../login.php");
		}
	} else {
		$_SESSION['message'] = "Please fill in all fields for login!";
		header("Location: ../login.php");
	}
}

if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}


// ---- Account Handlers (Edit/Delete) ----

if (isset($_POST['editAccountBtn'])) {
	// sanitize inputs to prevent XSS
	$username = sanitizeInput($_POST['username']);
	$email = sanitizeInput($_POST['email']);
	$query = updateAccount($pdo, $username, $email, $_GET['account_id'], $_SESSION['username']);
	if ($query) {
		header("Location: ../index.php");
	} else {
		echo "Edit failed";
	}
}

if (isset($_POST['deleteAccountBtn'])) {
	$query = deleteAccount($pdo, $_GET['account_id']);
	if ($query) {
		header("Location: ../index.php");
	} else {
		echo "Deletion failed";
	}
}


// ---- Guitar Handlers ----

if (isset($_POST['insertGuitarBtn'])) {
	// sanitize inputs to prevent XSS
	$guitarName = sanitizeInput($_POST['guitarName']);
	$guitarType = sanitizeInput($_POST['guitarType']);
	$query = insertGuitar($pdo, $guitarName, $guitarType, $_POST['quantity'], $_POST['price'], $_SESSION['username']);
	if ($query) {
		header("Location: ../guitars.php");
	} else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editGuitarBtn'])) {
	// sanitize inputs to prevent XSS
	$guitarName = sanitizeInput($_POST['guitarName']);
	$guitarType = sanitizeInput($_POST['guitarType']);
	$query = updateGuitar($pdo, $guitarName, $guitarType, $_POST['quantity'], $_POST['price'], $_GET['guitar_id'], $_SESSION['username']);
	if ($query) {
		header("Location: ../guitars.php");
	} else {
		echo "Edit failed";
	}
}

if (isset($_POST['deleteGuitarBtn'])) {
	$query = deleteGuitar($pdo, $_GET['guitar_id']);
	if ($query) {
		header("Location: ../guitars.php");
	} else {
		echo "Deletion failed";
	}
}


// ---- Other Product Handlers ----

if (isset($_POST['insertOtherProductBtn'])) {
	// sanitize inputs to prevent XSS
	$productName = sanitizeInput($_POST['productName']);
	$category = sanitizeInput($_POST['category']);
	$query = insertOtherProduct($pdo, $productName, $category, $_POST['quantity'], $_POST['price'], $_SESSION['username']);
	if ($query) {
		header("Location: ../otherproducts.php");
	} else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editOtherProductBtn'])) {
	// sanitize inputs to prevent XSS
	$productName = sanitizeInput($_POST['productName']);
	$category = sanitizeInput($_POST['category']);
	$query = updateOtherProduct($pdo, $productName, $category, $_POST['quantity'], $_POST['price'], $_GET['product_id'], $_SESSION['username']);
	if ($query) {
		header("Location: ../otherproducts.php");
	} else {
		echo "Edit failed";
	}
}

if (isset($_POST['deleteOtherProductBtn'])) {
	$query = deleteOtherProduct($pdo, $_GET['product_id']);
	if ($query) {
		header("Location: ../otherproducts.php");
	} else {
		echo "Deletion failed";
	}
}


// ---- Shopping Cart Handlers ----

if (isset($_POST['insertCartItemBtn'])) {
	// sanitize inputs to prevent XSS
	$itemName = sanitizeInput($_POST['itemName']);
	$itemType = sanitizeInput($_POST['itemType']);
	$query = insertCartItem($pdo, $_GET['account_id'], $itemName, $itemType, $_POST['quantity'], $_POST['price'], $_SESSION['username']);
	if ($query) {
		header("Location: ../viewcart.php?account_id=" . $_GET['account_id']);
	} else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editCartItemBtn'])) {
	// sanitize inputs to prevent XSS
	$itemName = sanitizeInput($_POST['itemName']);
	$itemType = sanitizeInput($_POST['itemType']);
	$query = updateCartItem($pdo, $itemName, $itemType, $_POST['quantity'], $_POST['price'], $_GET['cart_id'], $_SESSION['username']);
	if ($query) {
		header("Location: ../viewcart.php?account_id=" . $_GET['account_id']);
	} else {
		echo "Edit failed";
	}
}

if (isset($_POST['deleteCartItemBtn'])) {
	$query = deleteCartItem($pdo, $_GET['cart_id']);
	if ($query) {
		header("Location: ../viewcart.php?account_id=" . $_GET['account_id']);
	} else {
		echo "Deletion failed";
	}
}

?>
