<?php
    include("inc/config.php");
    include("inc/classes/Account.php");
    include("inc/classes/Constants.php");

    $account = new Account($con);

    include("inc/handlers/register-handler.php");
    include("inc/handlers/login-handler.php");

    function getInputValue($name)
    {
        if (isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<html>
<head>
	<title>Welcome</title>
	<link rel="stylesheet" type="text" href="assets/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.css">

	<script
  src="https://code.jquery.com/jquery-3.2.1.min.js"
  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
  crossorigin="anonymous"></script>
 <script src="assets/js/script.js"></script>
</head>
<body>
<?php

    if (isset($_POST['registerButton'])) {
        echo '<script>
				$(document).ready(function() {
					$("#loginForm").hide();
					$("#registerForm").show();
				});
			</script>';
    } else {
        echo '<script>
				$(document).ready(function() {
					$("#loginForm").show();
					$("#registerForm").hide();
				});
			</script>';
    }

    ?>

	<div id="container" class="container">
		<div class="columns">
			<form id="loginForm" action="register.php" method="POST" class="is-half">
				<h1 class="is-size-2">Login to your account</h1>
				<div class="field">
					<?php echo $account->getError(Constants::$loginFailed); ?>
					<label for="loginEmail" class="label">Email</label>
					<div class="control">
						<input id="loginEmail"  class="input" name="loginEmail" type="text" placeholder="name" required>
					</div>
				</div>

				<div class="field">
					<label for="loginPassword" class="label">Password</label>
					<div class="control">
						<input id="loginPassword"   class="input" name="loginPassword" type="password" placeholder="Your password" required>
					</div>
				</div>

				<button type="submit"  class="button is-success" name="loginButton">LOG IN</button>
				<div class="hasAccount">
					<span id="hideLogin">Don't have an account yet? Signup here.</span>
				</div>
			</form>
		</div>

		<div class="columns">
			<form id="registerForm" action="register.php" method="POST" class="is-half">
				<h1 class="is-size-2">Create your free account</h1>
				<div class="field">
					<?php echo $account->getError(Constants::$nameCharacters); ?>
					<label for="name" class="label">Name</label>
					<div class="control">
						<input type="text" name="name" class="input" id="name" placeholder="name" required>
					</div>
				</div>

				<div class="field">
					<?php echo $account->getError(Constants::$emailInvalid); ?>
					<label for="email" class="label">Email</label>
					<div class="control">
						<input type="email"  class="input" name="email" id="email" placeholder="johndoe@example.com" required>
					</div>
				</div>

				<div class="field">
					<?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
					<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
					<?php echo $account->getError(Constants::$passwordCharacters); ?>
					<label for="password" class="label">Password</label>
					<div class="control">
						<input id="password" class="input" name="password" type="password" placeholder="Your password" required>
					</div>
				</div>

				<div class="field">
					<label for="password2" class="label">Confirm password</label>
					<div class="control">
						<input id="password2" class="input" name="password2" type="password" placeholder="Your password" required>
					</div>
				</div>

				<button type="submit" class="button is-success" name="registerButton">SIGN UP</button>
				<div class="hasAccount">
					<span id="hideRegister">Already have an account? login here.</span>
				</div>
			</form>


	</div>
</body>
</html>