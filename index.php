<?php
require_once 'functions.php';
require_once 'vendor/autoload.php';

use Pheal\Pheal;

session_start();

$pheal = new Pheal();
$response = $pheal -> serverScope -> ServerStatus();

$good_user = NULL;
$good_pass = NULL;
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;

$msg = '';
if (isset($_POST['submit']))
{
	$result = getDb() -> query('SELECT * FROM `user`');
	while ($row = $result -> fetch(PDO::FETCH_ASSOC))
	{
		if ($_POST['user_id'] == $row['id'] && $_POST['password'] == $row['password'])
		{
			$good_user = isset($_POST['user_id']) && $_POST['user_id'] == $row['id'];
			$good_pass = isset($_POST['password']) && $_POST['password'] == $row['password'];

			$msg = "You have logged in successfully!";

			$_SESSION['logged_in'] = true;
			$_SESSION['user_id'] = $row['id'];
		} else
		{
			$msg = "Incorrect username or password.";
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>EVE Reports</title>
		<meta content="text/html; charset=UTF-8" /> 
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>
	<body>
		<div id="wrapper">
			<header>
				<h1><a href="index.php">EVE Reports</a></h1>
			</header>
			<?php if ($good_user && $good_pass || $logged_in): ?>
				<nav>
					<a href="index.php">Home</a>
					<a href="api.php">Add API</a>
					<a href="logout.php">Logout</a>
				</nav>
				<p>
					<?php
					echo sprintf("Hello Visitor! The EVE Online Server is: %s!, current amount of online players: %s", $response -> serverOpen ? "open" : "closed", $response -> onlinePlayers);
					?>
				</p>
			<?php else: ?>
				<nav>
					<a href="index.php">Home</a>
					<a href="register.php">Register</a>
				</nav>
				<?php if (!empty($msg)): ?>
				<h3><?php echo $msg; ?></h3>
				<?php endif; ?>
				<form action="" method="post">
					Username: <br />
					<input type="text" name="user_id" id="user_id" required /><br />
					Password: <br />
					<input type="password" name="password" id="password" required /><br />
					<input type="submit" name="submit" id="submit" />
				</form>
			<?php endif; ?>
		</div>
	</body>
</html>