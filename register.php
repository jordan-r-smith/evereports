<?php
require_once 'functions.php';

session_start();

$msg = '';

if (isset($_POST['submit']))
{
	$insert = getDb() -> prepare('INSERT INTO `user` (`id`, `email`, `password`) VALUES (?, ?, ?)');
	$result = $insert -> execute(array($_POST['user_id'], $_POST['email'], $_POST['password']));

	if ($result)
	{
		//$msg = "You have registered successfully!";
		$_SESSION['logged_in'] = true;
		$_SESSION['user_id'] = $_POST['user_id'];
		unset($_POST);
		header("Location: index.php");
	}
}
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
			<?php include 'templates/header.php'; ?>
			<nav>
				<a href="index.php">Login</a>
				<a href="register.php">Register</a>
			</nav>
			<p>
				Register for an account!
			</p>
			<?php if (!empty($msg)): ?>
			<h3><?php echo $msg; ?></h3>
			<?php endif; ?>
			<form action="register.php" method="post" onsubmit="return validatePassword()" id="registration">
				<label for="user_id">Username: </label><br />
				<input type="text" name="user_id" id="user_id" required /><br />
				<label for="email">Email: </label><br />
				<input type="email" name="email" id="email" required /><br />
				<label for="password">Password: </label><br />
				<input type="password" name="password" id="password" required /><br />
				<label for="confirm_password">Confirm Password: </label><br />
				<input type="password" name="confirm_password" id="confirm_password" required /><br />
				<input type="submit" name="submit" id="submit" />
			</form>
		</div>
	</body>
</html>