<?php
require_once 'functions.php';
require_once 'vendor/autoload.php';

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

session_start();
logOn();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>EVE Reports</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<link href="assets/css/darkly.min.css" rel="stylesheet">
		<link href="assets/css/custom.style.css" rel="stylesheet">
	</head>
	<body>
		<div class="navbar navbar-default navbar-static-top" role="navigation">
			<nav class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="">EVE Reports</a>
				</div>
				<div class="navbar-collapse collapse in navbar-responsive-collapse">
					<?php
					if (isset($_SESSION['user_id']))
					{
						include 'templates/nav_logged_true.php';
					} else
					{
						include 'templates/nav_logged_false.php';
					}
					?>
				</div>
			</nav>
		</div>
		<div class="jumbotron">
			<div class="container">
				<header>
					<a href="index.php"><img src="assets/img/banner.jpg" class="img-responsive" alt="EVE Reports" /></a>
				</header>
			</div>
		</div>
		<div class="container">
			<?php
			if (isset($_SESSION['user_id']))
			{
				if (!empty($_GET['charID']))
				{
					$query = getDb() -> prepare('SELECT * FROM `api` WHERE `keyID` = ?');
					$query -> execute(array($_GET['keyID']));

					while ($row = $query -> fetch(PDO::FETCH_ASSOC))
					{
						try
						{
							# CharacterSheet API Function
							$charRequest = new Pheal($row['keyID'], $row['vCode'], 'char');
							$charRequest -> detectAccess();

							$charArguments = array('characterID' => $_GET['charID']);
							$charSheet = $charRequest -> CharacterSheet($charArguments);

							$skills = $charSheet;
							$skills = $skills -> skills -> toArray();

							$totalSP = 0;
							foreach ($skills as $skill)
							{
								$skillPoints = $skill['skillpoints'];
								$totalSP = $totalSP + $skillPoints;
							}

							$charSheetData = $charSheet -> toArray();
							if (isset($charSheetData['result']))
							{
								$charSheetData = $charSheetData['result'];
							}

							$id = (int)$_GET['charID'];

							# CharacterInfo API Function
							$eveRequest = new Pheal($row['keyID'], $row['vCode'], 'eve');
							$eveRequest -> detectAccess();
							
							$charInfo = $eveRequest -> CharacterInfo($charArguments);
							$charInfoData = $charInfo -> toArray();
							if (isset($charInfoData['result']))
							{
								$charInfoData = $charInfoData['result'];
							}
						} catch (\Pheal\Exceptions\PhealException $e)
						{
							echo sprintf("Error: %s Message: %s", get_class($e), $e -> getMessage());
						}
					}
				}
				include 'templates/char_sheet.php';
				include 'templates/skill_list.php';
			}
			?>
			<hr/>
			<footer>
				<p>
					&copy; EVEReports.com 2014
				</p>
			</footer>
		</div>
		<?php require_once 'templates/footer_scripts.php'; ?>
	</body>
</html>