<?php


	if (isset($_POST['registerButton'])) {
		// Register button was pressed

		// Look at sanatising the data
		$username = sanitizeFormUsername($_POST['username']);
		$firstname = sanatizeFormString($_POST['firstname']);
		$lastname = sanatizeFormString($_POST['lastname']);
		
		$email = sanatizeFormString($_POST['email']);
		$email2 = sanatizeFormString($_POST['email2']);

		// Sanitize password
		$password = sanatizeFormPassword($_POST['password']);
		$password2 = sanatizeFormPassword($_POST['password2']);

		$wasSuccessful = $account->register($username, $firstname, $lastname, $email, $email2, $password, $password2);

		if ($wasSuccessful) {
			$_SESSION['userLoggedIn'] = $username;
			header("location: index.php");
		}
	}



	function sanitizeFormUsername($inputText) {
		$inputText = strip_tags($inputText);
		$inputText = str_replace(" ", "", $inputText);

		return $inputText;
	}

	function sanatizeFormString($inputText) {
		$inputText = strip_tags($inputText);
		$inputText = str_replace(" ", "", $inputText);
		$inputText = ucfirst(strtolower($inputText));

		return $inputText;
	}

	function sanatizeFormPassword($inputText) {
		$inputText = strip_tags($inputText);
		$inputText = str_replace(" ", "", $inputText);

		return $inputText;
	}

?>