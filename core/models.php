<?php  

// ---- Account Functions ----

function insertAccount($pdo, $username, $email, $password) {
	$sql = "INSERT INTO accounts (username, email, password) VALUES(?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username, $email, $password]);
	if ($executeQuery) {
		return true;
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

function updateAccount($pdo, $username, $email, $account_id) {
	$sql = "UPDATE accounts SET username = ?, email = ? WHERE account_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$username, $email, $account_id]);
	if ($executeQuery) {
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
			return true;
		}
	}
}


// ---- Guitar Functions ----

function insertGuitar($pdo, $guitar_name, $guitar_type, $quantity, $price) {
	$sql = "INSERT INTO guitars (guitar_name, guitar_type, quantity, price) VALUES(?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$guitar_name, $guitar_type, $quantity, $price]);
	if ($executeQuery) {
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

function updateGuitar($pdo, $guitar_name, $guitar_type, $quantity, $price, $guitar_id) {
	$sql = "UPDATE guitars SET guitar_name = ?, guitar_type = ?, quantity = ?, price = ? WHERE guitar_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$guitar_name, $guitar_type, $quantity, $price, $guitar_id]);
	if ($executeQuery) {
		return true;
	}
}

function deleteGuitar($pdo, $guitar_id) {
	$sql = "DELETE FROM guitars WHERE guitar_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$guitar_id]);
	if ($executeQuery) {
		return true;
	}
}


// ---- Other Product Functions ----

function insertOtherProduct($pdo, $product_name, $category, $quantity, $price) {
	$sql = "INSERT INTO other_products (product_name, category, quantity, price) VALUES(?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$product_name, $category, $quantity, $price]);
	if ($executeQuery) {
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

function updateOtherProduct($pdo, $product_name, $category, $quantity, $price, $product_id) {
	$sql = "UPDATE other_products SET product_name = ?, category = ?, quantity = ?, price = ? WHERE product_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$product_name, $category, $quantity, $price, $product_id]);
	if ($executeQuery) {
		return true;
	}
}

function deleteOtherProduct($pdo, $product_id) {
	$sql = "DELETE FROM other_products WHERE product_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$product_id]);
	if ($executeQuery) {
		return true;
	}
}


// ---- Shopping Cart Functions ----

function insertCartItem($pdo, $account_id, $item_name, $item_type, $quantity, $price) {
	$sql = "INSERT INTO shopping_cart (account_id, item_name, item_type, quantity, price) VALUES(?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$account_id, $item_name, $item_type, $quantity, $price]);
	if ($executeQuery) {
		return true;
	}
}

function getCartByAccount($pdo, $account_id) {
	$sql = "SELECT 
				shopping_cart.cart_id AS cart_id,
				shopping_cart.item_name AS item_name,
				shopping_cart.item_type AS item_type,
				shopping_cart.quantity AS quantity,
				shopping_cart.price AS price,
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
				shopping_cart.item_name AS item_name,
				shopping_cart.item_type AS item_type,
				shopping_cart.quantity AS quantity,
				shopping_cart.price AS price,
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

function updateCartItem($pdo, $item_name, $item_type, $quantity, $price, $cart_id) {
	$sql = "UPDATE shopping_cart SET item_name = ?, item_type = ?, quantity = ?, price = ? WHERE cart_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$item_name, $item_type, $quantity, $price, $cart_id]);
	if ($executeQuery) {
		return true;
	}
}

function deleteCartItem($pdo, $cart_id) {
	$sql = "DELETE FROM shopping_cart WHERE cart_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$cart_id]);
	if ($executeQuery) {
		return true;
	}
}

?>
