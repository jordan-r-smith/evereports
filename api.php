<?php
require_once 'functions.php';
require_once 'vendor/autoload.php';

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('.pheal/cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

session_start();
logOn();
addAPI();

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
				<?php if (!empty($msg)): ?>
				<h3><?php echo $msg; ?></h3>
				<?php endif; ?>
				<p>
					<a href="https://api.eveonline.com/" target="_blank">Create new API key</a>
				</p>
				<form action="" method="post" id="addapi">
					<label for="keyID">keyID: </label>
					<input name="keyID" id="keyID" /><br />
					<label for="vCode">vCode: </label>
					<input name="vCode" id="vCode" /><br />
					<input type="submit" name="add_api" id="submit">
				</form>
			<?php else:
				include 'templates/nav_logged_false.php';
				include 'templates/login.php';
			endif; ?>
		</div>
	</body>
</html>