<?php  

require_once 'dbConfig.php';

// ---- User Functions (Login/Register) ----

// check if username exists, if not insert new account
function insertNewUser($pdo, $username, $email, $password) {
	$checkUserSql = "SELECT * FROM accounts WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {
		$sql = "INSERT INTO accounts (username, email, password) VALUES(?,?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $email, $password]);

		if ($executeQuery) {
			$_SESSION['message'] = "User successfully registered";
			insertActivityLog($pdo, "REGISTERED new account called {$username}", "Accounts", $username);
			return true;
		} else {
			$_SESSION['message'] = "An error occured from the query";
		}
	} else {
		$_SESSION['message'] = "User already exists";
	}
}

// verify username and password for login
function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM accounts WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]); 

	if ($stmt->rowCount() == 1) {
		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username']; 
		$passwordFromDB = $userInfoRow['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		} else {
			$_SESSION['message'] = "Password is invalid";
		}
	}

	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist. Please register first";
	}
}

function getAllAccounts($pdo) {
	$sql = "SELECT * FROM accounts";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getAccountByID($pdo, $account_id) {
	$sql = "SELECT * FROM accounts WHERE account_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$account_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}



// ---- Account Functions (Update/Delete) ----


// update with updated_by tracking
function updateAccount($pdo, $username, $email, $account_id, $updated_by) {
	$sql = "UPDATE accounts SET username = ?, email = ?, updated_by = ? WHERE account_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username, $email, $updated_by, $account_id]);
	if ($executeQuery) {
		insertActivityLog($pdo, "UPDATED account ID {$account_id}", "Accounts", $updated_by);
		return true;
	}
}

function deleteAccount($pdo, $account_id) {
	// delete cart items of this account first
	$deleteCart = "DELETE FROM shopping_cart WHERE account_id = ?";
	$deleteStmt = $pdo->prepare($deleteCart);
	$executeDeleteQuery = $deleteStmt->execute([$account_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM accounts WHERE account_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$account_id]);
		if ($executeQuery) {
			insertActivityLog($pdo, "DELETED account ID {$account_id}", "Accounts", $_SESSION['username']);
			return true;
		}
	}
}


// ---- Guitar Functions ----

// insert with added_by tracking
function insertGuitar($pdo, $guitar_name, $guitar_type, $quantity, $price, $added_by) {
	$sql = "INSERT INTO guitars (guitar_name, guitar_type, quantity, price, added_by) VALUES(?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$guitar_name, $guitar_type, $quantity, $price, $added_by]);
	if ($executeQuery) {
		insertActivityLog($pdo, "INSERTED a new guitar record called {$guitar_name}", "Guitars", $added_by);
		return true;
	}
}

function getAllGuitars($pdo) {
	$sql = "SELECT * FROM guitars";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getGuitarByID($pdo, $guitar_id) {
	$sql = "SELECT * FROM guitars WHERE guitar_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$guitar_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

// update with updated_by tracking
function updateGuitar($pdo, $guitar_name, $guitar_type, $quantity, $price, $guitar_id, $updated_by) {
	$sql = "UPDATE guitars SET guitar_name = ?, guitar_type = ?, quantity = ?, price = ?, updated_by = ? WHERE guitar_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$guitar_name, $guitar_type, $quantity, $price, $updated_by, $guitar_id]);
	if ($executeQuery) {
		insertActivityLog($pdo, "UPDATED guitar record {$guitar_name}", "Guitars", $updated_by);
		return true;
	}
}

function deleteGuitar($pdo, $guitar_id) {
	$sql = "DELETE FROM guitars WHERE guitar_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$guitar_id]);
	if ($executeQuery) {
		insertActivityLog($pdo, "DELETED guitar ID {$guitar_id}", "Guitars", $_SESSION['username']);
		return true;
	}
}


// ---- Other Product Functions ----

// insert with added_by tracking
function insertOtherProduct($pdo, $product_name, $category, $quantity, $price, $added_by) {
	$sql = "INSERT INTO other_products (product_name, category, quantity, price, added_by) VALUES(?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$product_name, $category, $quantity, $price, $added_by]);
	if ($executeQuery) {
		insertActivityLog($pdo, "INSERTED a new product record called {$product_name}", "Other Products", $added_by);
		return true;
	}
}

function getAllOtherProducts($pdo) {
	$sql = "SELECT * FROM other_products";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getOtherProductByID($pdo, $product_id) {
	$sql = "SELECT * FROM other_products WHERE product_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$product_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

// update with updated_by tracking
function updateOtherProduct($pdo, $product_name, $category, $quantity, $price, $product_id, $updated_by) {
	$sql = "UPDATE other_products SET product_name = ?, category = ?, quantity = ?, price = ?, updated_by = ? WHERE product_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$product_name, $category, $quantity, $price, $updated_by, $product_id]);
	if ($executeQuery) {
		insertActivityLog($pdo, "UPDATED product record {$product_name}", "Other Products", $updated_by);
		return true;
	}
}

function deleteOtherProduct($pdo, $product_id) {
	$sql = "DELETE FROM other_products WHERE product_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$product_id]);
	if ($executeQuery) {
		insertActivityLog($pdo, "DELETED product ID {$product_id}", "Other Products", $_SESSION['username']);
		return true;
	}
}


// ---- Shopping Cart Functions ----

// insert with added_by tracking
function insertCartItem($pdo, $account_id, $item_name, $item_type, $quantity, $price, $added_by) {
	$sql = "INSERT INTO shopping_cart (account_id, item_name, item_type, quantity, price, added_by) VALUES(?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$account_id, $item_name, $item_type, $quantity, $price, $added_by]);
	if ($executeQuery) {
		insertActivityLog($pdo, "INSERTED cart item {$item_name} for account ID {$account_id}", "Shopping Cart", $added_by);
		return true;
	}
}

function getCartByAccount($pdo, $account_id) {
	$sql = "SELECT 
				shopping_cart.cart_id AS cart_id,
				shopping_cart.account_id AS account_id,
				shopping_cart.item_name AS item_name,
				shopping_cart.item_type AS item_type,
				shopping_cart.quantity AS quantity,
				shopping_cart.price AS price,
				shopping_cart.added_by AS added_by,
				shopping_cart.updated_by AS updated_by,
				shopping_cart.date_added AS date_added,
				accounts.username AS username
			FROM shopping_cart
			JOIN accounts ON shopping_cart.account_id = accounts.account_id
			WHERE shopping_cart.account_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$account_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getCartItemByID($pdo, $cart_id) {
	$sql = "SELECT 
				shopping_cart.cart_id AS cart_id,
				shopping_cart.account_id AS account_id,
				shopping_cart.item_name AS item_name,
				shopping_cart.item_type AS item_type,
				shopping_cart.quantity AS quantity,
				shopping_cart.price AS price,
				shopping_cart.added_by AS added_by,
				shopping_cart.updated_by AS updated_by,
				shopping_cart.date_added AS date_added,
				accounts.username AS username
			FROM shopping_cart
			JOIN accounts ON shopping_cart.account_id = accounts.account_id
			WHERE shopping_cart.cart_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$cart_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

// update with updated_by tracking
function updateCartItem($pdo, $item_name, $item_type, $quantity, $price, $cart_id, $updated_by) {
	$sql = "UPDATE shopping_cart SET item_name = ?, item_type = ?, quantity = ?, price = ?, updated_by = ? WHERE cart_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$item_name, $item_type, $quantity, $price, $updated_by, $cart_id]);
	if ($executeQuery) {
		insertActivityLog($pdo, "UPDATED cart item {$item_name}", "Shopping Cart", $updated_by);
		return true;
	}
}

function deleteCartItem($pdo, $cart_id) {
	$sql = "DELETE FROM shopping_cart WHERE cart_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$cart_id]);
	if ($executeQuery) {
		insertActivityLog($pdo, "DELETED cart item ID {$cart_id}", "Shopping Cart", $_SESSION['username']);
		return true;
	}
}

// ---- Activity Logs Functions ----
function insertActivityLog($pdo, $operation, $location_name, $username) {
	$sql = "INSERT INTO activity_logs (operation, location_name, username) VALUES(?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$operation, $location_name, $username]);
	if ($executeQuery) {
		return true;
	}
}

function getAllActivityLogs($pdo) {
	$sql = "SELECT * FROM activity_logs ORDER BY date_added DESC";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

// ---- Search Functions ----
function searchAccounts($pdo, $searchQuery) {
	$sql = "SELECT * FROM accounts WHERE username LIKE ? OR email LIKE ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%" . $searchQuery . "%", "%" . $searchQuery . "%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function searchCartItems($pdo, $account_id, $searchQuery) {
	$sql = "SELECT 
				shopping_cart.cart_id AS cart_id,
				shopping_cart.account_id AS account_id,
				shopping_cart.item_name AS item_name,
				shopping_cart.item_type AS item_type,
				shopping_cart.quantity AS quantity,
				shopping_cart.price AS price,
				shopping_cart.added_by AS added_by,
				shopping_cart.updated_by AS updated_by,
				shopping_cart.date_added AS date_added,
				accounts.username AS username
			FROM shopping_cart
			JOIN accounts ON shopping_cart.account_id = accounts.account_id
			WHERE shopping_cart.account_id = ? AND (shopping_cart.item_name LIKE ? OR shopping_cart.item_type LIKE ?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$account_id, "%" . $searchQuery . "%", "%" . $searchQuery . "%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function searchAllCartItems($pdo, $searchQuery) {
	$sql = "SELECT 
				shopping_cart.cart_id AS cart_id,
				shopping_cart.account_id AS account_id,
				shopping_cart.item_name AS item_name,
				shopping_cart.item_type AS item_type,
				shopping_cart.quantity AS quantity,
				shopping_cart.price AS price,
				shopping_cart.added_by AS added_by,
				shopping_cart.updated_by AS updated_by,
				shopping_cart.date_added AS date_added,
				accounts.username AS username
			FROM shopping_cart
			JOIN accounts ON shopping_cart.account_id = accounts.account_id
			WHERE shopping_cart.item_name LIKE ? OR shopping_cart.item_type LIKE ? OR accounts.username LIKE ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%" . $searchQuery . "%", "%" . $searchQuery . "%", "%" . $searchQuery . "%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

?>
