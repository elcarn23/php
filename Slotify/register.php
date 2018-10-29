<?php 
include("includes/config.php");
include("includes/classes/Account.php");
include("includes/classes/Constants.php");

$account = new Account($connection);

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name) {
	if (isset($_POST[$name])) {
		echo $_POST[$name];
	}
}

?>

<!DOCTYPE html>

<html>
<head>
	<title>Slotify</title>
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">
</head>
<body>
	<div id="background">
		<div id="inputContainer">
			<!-- Login Form -->
			<form id="loginForm" action="register.php" method="POST">
				<h2>Login to your account</h2>
				<p>
					<?php echo $account->getError(Constants::$loginFailed); ?>
					<label for="loginUserName">Username:</label>
					<input id="loginUserName" type="text" name="loginUserName" placeholder="e.g. Bart Simpson" required>
				</p>
				<p>
					<label for="loginPassword">Password:</label>
					<input id="loginPassword" type="password" name="loginPassword" required>
				</p>
				<button type="submit" name="loginButton"> Log In</button>
			</form>

			<!-- Register Form -->
			<form id="registerForm" action="register.php" method="POST">
				<h2>Create your free account.</h2>
				<!-- User Inputs -->
				<p>
					<?php echo $account->getError(Constants::$userNameLengthError); ?>
					<?php echo $account->getError(Constants::$userNameTaken); ?>
					<label for="username">Username:</label>
					<input id="username" type="text" name="username" placeholder="e.g. Bart Simpson" value="<?php getInputValue('username') ?>" required>
				</p>
				<p>
					<?php echo $account->getError(Constants::$firstNameLengthError); ?>
					<label for="firstname">First Name:</label>
					<input id="firstname" type="text" name="firstname" placeholder="e.g. Bart" value="<?php getInputValue('firstname') ?>" required>
				</p>
				<p>
					<?php echo $account->getError(Constants::$lastNameLengthError); ?>
					<label for="lastname">Last Name:</label>
					<input id="lastname" type="text" name="lastname" placeholder="e.g. Simpson" value="<?php getInputValue('lastname') ?>" required>
				</p>
				<p>
					<?php echo $account->getError(Constants::$emailsNonMatchError); ?>
					<?php echo $account->getError(Constants::$emailNotValidError); ?>
					<?php echo $account->getError(Constants::$emailAlreadyUsed); ?>
					<label for="email">Email:</label>
					<input id="email" type="email" name="email" placeholder="e.g. something@somewhere.com" value="<?php getInputValue('email') ?>" required>
				</p>
				<p>
					<label for="email2">Confirm Email:</label>
					<input id="email2" type="email" name="email2" placeholder="e.g. something@somewhere.com" value="<?php getInputValue('email2') ?>" required>
				</p>



				<!-- Password Section -->
				<p>
					<?php echo $account->getError(Constants::$passwordNonMatch); ?>
					<?php echo $account->getError(Constants::$passwordNonAlphaNumeric); ?>
					<?php echo $account->getError(Constants::$passwordLengthError); ?>
					<label for="password">Password:</label>
					<input id="password" type="password" name="password" required>
				</p>

				<p>
					<label for="password2">Confirm Password:</label>
					<input id="password2" type="password" name="password2" required>
				</p>
				<button type="submit" name="registerButton"> Sign Up</button>
			</form>

		</div>
	</div>
		
</body>
</html>