<?php 

	class Constants {
		// Registration error constants
		// Username validation
		public static $userNameLengthError     = "Your username must be between 5 and 25 characters.";
		public static $userNameTaken           = "This username is already taken.";
	
		// Name validation
		public static $firstNameLengthError    = "Your first name must be between 2 and 25 characters.";
		public static $lastNameLengthError     = "Your last name must be between 2 and 25 characters.";

		// Email validation
		public static $emailsNonMatchError     = "Emails do not match.";
		public static $emailNotValidError      = "Email is not valid.";
		public static $emailAlreadyUsed        = "This email has already been used to create an account.";

		// Password validation
		public static $passwordNonMatch        = "Passwords do not match.";
		public static $passwordNonAlphaNumeric = "Passwords can only contain alpha numeric values.";
		public static $passwordLengthError     = "Password must be between 5 and 30 characters.";


		// Login Form Errors
		public static $loginFailed = "Your username or password was incorrect.";
	}
?>