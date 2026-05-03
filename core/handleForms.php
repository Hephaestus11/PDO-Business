<?php 

require_once 'dbConfig.php';
require_once 'models.php';


// ---- User Handlers (Register/Login/Logout) ----

if (isset($_POST['registerUserBtn'])) {
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($email) && !empty($password)) {
		$insertQuery = insertNewUser($pdo, $username, $email, $password);
		if ($insertQuery) {
			header("Location: ../login.php");
		} else {
			header("Location: ../register.php");
		}
	} else {
		$_SESSION['message'] = "Please fill in all fields for registration!";
		header("Location: ../register.php");
	}
}

if (isset($_POST['loginUserBtn'])) {
	$username = $_POST['username'];
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
	$query = updateAccount($pdo, $_POST['username'], $_POST['email'], $_GET['account_id'], $_SESSION['username']);
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
	$query = insertGuitar($pdo, $_POST['guitarName'], $_POST['guitarType'], $_POST['quantity'], $_POST['price'], $_SESSION['username']);
	if ($query) {
		header("Location: ../guitars.php");
	} else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editGuitarBtn'])) {
	$query = updateGuitar($pdo, $_POST['guitarName'], $_POST['guitarType'], $_POST['quantity'], $_POST['price'], $_GET['guitar_id'], $_SESSION['username']);
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
	$query = insertOtherProduct($pdo, $_POST['productName'], $_POST['category'], $_POST['quantity'], $_POST['price'], $_SESSION['username']);
	if ($query) {
		header("Location: ../otherproducts.php");
	} else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editOtherProductBtn'])) {
	$query = updateOtherProduct($pdo, $_POST['productName'], $_POST['category'], $_POST['quantity'], $_POST['price'], $_GET['product_id'], $_SESSION['username']);
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
	$query = insertCartItem($pdo, $_GET['account_id'], $_POST['itemName'], $_POST['itemType'], $_POST['quantity'], $_POST['price'], $_SESSION['username']);
	if ($query) {
		header("Location: ../viewcart.php?account_id=" . $_GET['account_id']);
	} else {
		echo "Insertion failed";
	}
}

if (isset($_POST['editCartItemBtn'])) {
	$query = updateCartItem($pdo, $_POST['itemName'], $_POST['itemType'], $_POST['quantity'], $_POST['price'], $_GET['cart_id'], $_SESSION['username']);
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
