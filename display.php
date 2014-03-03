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
				
				if (!empty($_GET['charID'])):
					$query = getDb() -> prepare('SELECT * FROM `api` WHERE `keyID` = ?');
					$query -> execute(array($_GET['keyID']));
					
					while ($row = $query -> fetch(PDO::FETCH_ASSOC))
					{
						try
						{
							$request = new Pheal($row['keyID'], $row['vCode'], 'char');
							$request -> detectAccess();
							
							$arguments = array('characterID' => $_GET['charID']);
							$charSheet = $request -> CharacterSheet($arguments);
							
							$skills = $charSheet;
							$skills = $skills->skills->toArray();
							
							$totalSP = 0;
							foreach ($skills as $skill)
							{
								$skillPoints = $skill['skillpoints'];
								$totalSP = $totalSP + $skillPoints;
							}
							
							$data = $charSheet -> toArray();
							
							if (isset($data['result']))
								$data = $data['result'];
							
							$id = (int)$_GET['charID'];
						} catch (\Pheal\Exceptions\PhealException $e)
						{
							echo sprintf("Error: %s Message: %s", get_class($e), $e -> getMessage());
						}
					}
				endif;
				
				if (!empty($msg)):
					echo sprintf("<h3>%s</h3>", $msg);
				elseif (empty($id)):
					echo '<h1>Error</h1><p>No character with this ID found</p>';
				else:
					?>
					<h1><?php echo $data['name']; ?></h1>
					<div class="col"><img src="http://image.eveonline.com/Character/<?php echo $data['characterID']; ?>_256.jpg" width="256" height="256" alt="<?php echo $data['name']; ?>"></div>
					<div class="col">
						<?php if (!empty($data['allianceName'])): ?>
						<h2><?php echo $data['allianceName']; ?></h2>
						<p><img src="http://image.eveonline.com/Alliance/<?php echo $data['allianceID']; ?>_128.png" width="128" height="128" alt="<?php echo $data['allianceName']; ?>"></p>
						<?php endif; ?>
						<h2><?php echo $data['corporationName']; ?></h2>
						<p><img src="http://image.eveonline.com/Corporation/<?php echo $data['corporationID']; ?>_128.png" width="128" height="128" alt="<?php echo $data['corporationName']; ?>"></p>
						<h2>Stats</h2>
						<table>
							<thead>
								<tr>
									<th>Property</th>
									<th>Value</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Bloodline</td>
									<td><?php echo $data['bloodLine']; ?></td>
								</tr>
								<tr>
									<td>Ancestry</td>
									<td><?php echo $data['ancestry']; ?></td>
								</tr>
								<tr>
									<td>Clone</td>
									<td><?php echo $data['cloneName']; ?></td>
								</tr>
								<tr>
									<td>Total Skillpoints</td>
									<td><?php echo number_format($totalSP); ?></td>
								</tr>
								<tr>
									<td>Wealth</td>
									<td><?php echo number_format($data['balance']) . " ISK"; ?></td>
								</tr>
								<tr>
									<td>Gender</td>
									<td><?php echo $data['gender']; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<h2>Skills</h2>
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Skillpoints</th>
								<th>Level</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$selectType = getDb()->prepare('SELECT `typeName` AS `name` FROM `invTypes` WHERE `typeID` = ?');
							
							foreach ($skills as $skill):
								$selectType->execute(array($skill['typeID']));
								$result = $selectType->fetchAll(PDO::FETCH_ASSOC);
								$skillName = $result[0]['name'];
								$skillPoints = $skill['skillpoints'];
								$totalSP = $totalSP + 1;
								$skillLevel = $skill['level'];
							?>
							<tr>
								<td><?php echo $skillName; ?></td>
								<td><?php echo $skillPoints; ?></td>
								<td><?php echo $skillLevel; ?></td>
							</tr>
							<?php
							endforeach;
							?>
						</tbody>
					</table>
				<?php endif;
			else:
				include 'templates/nav_logged_false.php';
				include 'templates/login.php';
			endif; ?>
		</div>
	</body>
</html>