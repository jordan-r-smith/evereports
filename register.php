<?php
require_once 'functions.php';

session_start();
registerAccount();

$msg = '';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>EVE Reports</title>
		<meta content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<script type="text/javascript">
			function validatePassword()
			{
				var pass1 = document.getElementById("password").value;
				var pass2 = document.getElementById("confirm_password").value;
				var ok = true;
				if (pass1 != pass2)
				{
					document.getElementById("password").style.borderColor = "#E34234";
					document.getElementById("confirm_password").style.borderColor = "#E34234";
					ok = false;
				}
				return ok;
			}
		</script>
	</head>
	<body>
		<div id="wrapper">
			<?php
			include 'templates/header.php';
			include 'templates/nav_logged_false.php';
			?>
			<?php if (!empty($msg)): ?>
			<h3><?php echo $msg; ?></h3>
			<?php endif; ?>
			<p>
				Register for an account!
			</p>
			<form action="register.php" method="post" onsubmit="return validatePassword()" id="registration">
				<label for="user_id">Username: </label><br />
				<input type="text" name="user_id" id="user_id" required /><br />
				<label for="email">Email: </label><br />
				<input type="email" name="email" id="email" required /><br />
				<label for="password">Password: </label><br />
				<input type="password" name="password" id="password" required /><br />
				<label for="confirm_password">Confirm Password: </label><br />
				<input type="password" name="confirm_password" id="confirm_password" required /><br />
				<input type="submit" name="register" id="submit" />
			</form>
		</div>
	</body>
</html>