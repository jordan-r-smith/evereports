<?php
require_once 'functions.php';
require_once 'vendor/autoload.php';

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('.pheal/cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

session_start();

$logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;

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
			<?php include 'templates/header.php'; ?>
			<?php if ($logged_in): ?>
				<nav>
					<a href="index.php">Home</a>
					<a href="api.php">Add API</a>
					<a href="characters.php">Characters</a>
					<a href="logout.php">Logout</a>
				</nav>
				<?php
				if (isset($_SESSION['user_id']))
				{
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
								echo sprintf("<li><a href='display.php?charID=%s'><img src='http://image.eveonline.com/Character/%s_128.jpg' alt='%s' /></a></li>", 
									$character -> characterID, 
									$character -> characterID,
									$character -> name);
							}
							echo "</ul>";
						} catch (\Pheal\Exceptions\PhealException $e)
						{
							echo sprintf("Error: %s Message: %s", get_class($e), $e -> getMessage());
						}
					}
				}
				?>
			<?php else: ?>
				<nav>
					<a href="index.php">Home</a>
					<a href="register.php">Register</a>
				</nav>
				<?php if (!empty($msg)): ?>
				<h3><?php echo $msg; ?></h3>
				<?php endif; ?>
				<form action="" method="post" id="login">
					<label for="user_id">Username: </label>
					<input type="text" name="user_id" id="user_id" required /><br />
					<label for="password">Password: </label>
					<input type="password" name="password" id="password" required /><br />
					<input type="submit" name="logon" id="submit" />
				</form>
			<?php endif; ?>
		</div>
	</body>
</html>