<?php
require_once 'functions.php';
require_once 'vendor/autoload.php';

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('.pheal/cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

session_start();

$pheal = new Pheal();
$response = $pheal -> serverScope -> ServerStatus();

$good_user = NULL;
$good_pass = NULL;
$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;

$msg = '';
if (isset($_POST['logon']))
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
			<?php
			include 'templates/header.php';
			?>
			<?php if ($good_user && $good_pass || $logged_in):
			?>
			<nav>
				<a href="index.php">Home</a>
				<a href="api.php">Add API</a>
				<a href="characters.php">Characters</a>
				<a href="logout.php">Logout</a>
			</nav>
			<p>
				<?php
				echo sprintf("Hello %s! EVE Online's server is currently %s. There are currently %s players online.", $_SESSION['user_id'], $response -> serverOpen ? '<em id="online">online</em>' : '<em id="offline">offline</em>', $response -> onlinePlayers);
				?>
			</p>
			<p>
				You can use this website to add multiple account APIs to track your EVE Online character stats.
			</p>
			<?php else: ?>
			<?php
			include 'templates/login.php';
			?>
			<?php endif; ?>
		</div>
	</body>
</html>