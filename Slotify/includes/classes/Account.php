<?php

	class Account {
		private $error_array;
		private $db_connection;

		public function __construct($connection) {
			$this->error_array = array();
			$this->db_connection = $connection;
		}

		public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
			// Perform checks on the data
			$this->validateUserName($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmails($em, $em2);
			$this->validatePasswords($pw, $pw2);	

			if (empty($this->error_array)) {
				// No errors -- insert into the db
				return $this->insertUserDetails($un, $fn, $ln, $em, $pw);
			}		
			else {
				// Errors in the array.
				return false;
				//TODO: Need to output the issues.
			}
		}

		public function login($un, $pw) {
			$pw = md5($pw);
			$query = mysqli_query($this->db_connection, "SELECT * FROM users WHERE username = '$un' AND password = '$pw'");
			if (mysqli_num_rows($query) == 1) {
				return true;
			}
			else {
				array_push($this->error_array, Constants::$loginFailed);
				return false;
			}
		}

		public function getError($error) {
			if (!in_array($error, $this->error_array)) {
				$error = "";
			}
			return "<span class='errorMessage'>$error</span>";
		}

		private function insertUserDetails($un, $fn, $ln, $em, $pw) {
			$encryptedPw = md5($pw);
			$profilePic = "assets/images/profile-pics/Boo-Block.png";
			$date = date("Y-m-d");

			$result = mysqli_query($this->db_connection, "INSERT INTO users VALUES ('', '$un', '$fn', '$ln', '$em', '$encryptedPw', '$date', '$profilePic')");
			return $result;

		}

		private function validateUserName($userName) {
			if (strlen($userName) > 25 || strlen($userName) < 5) {
				array_push($this->error_array, Constants::$userNameLengthError);
				return;
			}

			//TODO: Check that the username doesn't already exist
			$checkUsernameExists = mysqli_query($this->db_connection, "SELECT username FROM users WHERE username = '$userName'");
			if (mysqli_num_rows($checkUsernameExists) != 0) {
				array_push($this->error_array, Constants::$userNameTaken);
				return;
			}
		}

		private function validateFirstName($firstName) {
			if (strlen($firstName) > 25 || strlen($firstName) < 2) {
				array_push($this->error_array, Constants::$firstNameLengthError);
				return;
			}
		}

		private function validateLastName($lastName) {
			if (strlen($lastName) > 25 || strlen($lastName) < 2) {
				array_push($this->error_array, Constants::$lastNameLengthError);
				return;
			}
		}

		private function validateEmails($em1, $em2) {
			if ($em1 != $em2) {
				array_push($this->error_array, Constants::$emailsNonMatchError);
				return;
			}
			if (!filter_var($em1, FILTER_VALIDATE_EMAIL)) {
				array_push($this->error_array, Constants::$emailNotValidError);
				return;
			}

			//TODO: Check that the email hasn't already been used.
			$checkEmailUsed = mysqli_query($this->db_connection, "SELECT username FROM users WHERE email = '$em1'");
			if (mysqli_num_rows($checkEmailUsed) != 0) {
				array_push($this->error_array, Constants::$emailAlreadyUsed);
				return;
			}

		}
		
		private function validatePasswords($pw1, $pw2) {
			if ($pw1 != $pw2) {
				array_push($this->error_array, Constants::$passwordNonMatch);
				return;
			}
			if (preg_filter('/[^A-Za-z0-9]/', '', $pw1)) {
				array_push($this->error_array, Constants::$passwordNonAlphaNumeric);
				return;
			}
			if (strlen($pw1) > 30 || strlen($pw1) < 5) {
				array_push($this->error_array, Constants::$passwordLengthError);
				return;
			}
		}
	}
?>