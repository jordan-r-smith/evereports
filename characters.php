<?php
require_once 'functions.php';
require_once 'vendor/autoload.php';

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('.pheal/cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

session_start();

$msg = '';
logOn();
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
				$query = getDb() -> prepare('SELECT * FROM `api` WHERE `id` = ?');
				$query -> execute(array($_SESSION['user_id']));
				while ($row = $query -> fetch(PDO::FETCH_ASSOC))
				{
					echo sprintf("<p>API ID %s:</p>", $row['keyID']);
					try
					{
						$request = new Pheal($row['keyID'], $row['vCode'], 'account');
						$request -> detectAccess();
						$char_list = $request -> Characters();
						echo "<ul class='characterList'>";
						foreach ($char_list->characters as $character)
						{
							echo sprintf("<li><a href='display.php?charID=%s&amp;keyID=%s'><img src='http://image.eveonline.com/Character/%s_128.jpg' alt='%s' /></a></li>", $character -> characterID, $row['keyID'], $character -> characterID, $character -> name);
						}
						echo "</ul>";
					} catch (\Pheal\Exceptions\PhealException $e)
					{
						echo sprintf("Error: %s Message: %s", get_class($e), $e -> getMessage());
					}
				}
			else:
				include 'templates/nav_logged_false.php';
				include 'templates/login.php';
			endif;
			?>
		</div>
	</body>
</html>