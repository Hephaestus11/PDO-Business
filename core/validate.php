<?php 

// validates password: must be more than 8 characters, with uppercase, lowercase, and numbers
function validatePassword($password) {

	if (strlen($password) > 8) {
		$hasLower = false;
		$hasUpper = false;
		$hasNumber = false;

	    for ($i = 0; $i < strlen($password); $i++) {

	    	if (ctype_lower($password[$i])) {
	    		$hasLower = true; 
	        } 

	        elseif (ctype_upper($password[$i])) {
	            $hasUpper = true; 
	        } 

	        elseif (ctype_digit($password[$i])) {
	            $hasNumber = true;
	        }

	        if ($hasLower && $hasUpper && $hasNumber) {
	            return true; 
	        }
	    }
	}

	else {
		return false; 
	}
}

// sanitizes input to prevent XSS: trims whitespace, removes backslashes, converts special characters
function sanitizeInput($data) {

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}

?>
