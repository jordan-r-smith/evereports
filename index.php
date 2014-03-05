<?php
require_once 'functions.php';
require_once 'vendor/autoload.php';

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('.pheal/cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

session_start();
logOn();

$msg = '';
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
if (isset($_SESSION['user_id'])):
include 'templates/nav_logged_true.php';
			?>
			<p>
				<?php
				$pheal = new Pheal();
				$response = $pheal -> serverScope -> ServerStatus();
				echo sprintf("Hello <strong>%s</strong>! EVE Online's server is currently %s. There are currently <strong>%s</strong> players online.", $_SESSION['user_id'], $response -> serverOpen ? '<em id="online">online</em>' : '<em id="offline">offline</em>', number_format($response -> onlinePlayers));
				?>
			</p>
			<p>
				You can use this website to add multiple account APIs to track your EVE Online character stats.
			</p>
			<?php else:
				include 'templates/nav_logged_false.php';
				include 'templates/login.php';
				endif;
			?>
		</div>
	</body>
</html>