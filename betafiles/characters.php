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
				<div class="navbar-collapse collapse navbar-responsive-collapse">
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
			if (isset($_SESSION['user_id'])):
			?>
			<div class="row">
				<?php
				$query = getDb() -> prepare('SELECT * FROM `api` WHERE `id` = ?');
				$query -> execute(array($_SESSION['user_id']));
				while ($row = $query -> fetch(PDO::FETCH_ASSOC))
				{
				?>
				<div class="col-md-6">
					<div class="panel panel-default">
						<div class="panel-heading">
					        <div class="dropdown pull-right">
					            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					            	<span class="glyphicon glyphicon-wrench"></span>
					            </a>
					            <ul class="dropdown-menu" role="menu">
					                <li><a href="">Modify</a></li>
					                <li>
					                	<a href="" id="delete"
					                		data-toggle="modal" 
					                		data-target="#confirmDelete" 
					                		data-title="Delete User" 
					                		data-message="Are you sure you want to delete this user ?"
					                		data-url="deleteAPI.php?keyID=<?= $row['keyID'] ?>">
					                		Delete
					                	</a>
					                </li>
					            </ul>
					        </div>
					        <h3 class="panel-title">API ID <?= $row['keyID'] ?>:</h3>
					    </div>
						<?php
						try
						{
							$accountRequest = new Pheal($row['keyID'], $row['vCode'], 'account');
							$accountRequest -> detectAccess();
							$characterList = $accountRequest -> Characters();
						?>
						<ul class="characterList panel-body text-center">
						<?php
							foreach ($characterList->characters as $character)
							{
								echo sprintf("
									<li>
										<a href='display.php?charID=%s&amp;keyID=%s' role='button' class='thumbnail' data-toggle='tooltip' title='%s'>
											<img src='http://image.eveonline.com/Character/%s_128.jpg' alt='%s' />
										</a>
									</li>", $character -> characterID, $row['keyID'], $character -> name, $character -> characterID, $character -> name);
							}
						?>
						</ul>
						<?php
						} catch (\Pheal\Exceptions\PhealException $e)
						{
							echo sprintf("Error: %s Message: %s", get_class($e), $e -> getMessage());
						}
						?>
					</div>
				</div>
				<?php
				}
				?>
			</div>
			<?php else:
				header("Location: index.php");
				endif;
			?>
			<hr/>
			<footer>
				<p>
					&copy; EVEReports.com 2014
				</p>
			</footer>
		</div>
		<?php require_once 'templates/footer_scripts.php'; ?>
		<script type="text/javascript">
			$('[data-toggle="tooltip"]').tooltip({
				'placement' : 'bottom'
			});	
		</script>
		<?php require_once('templates/delete_confirm.php'); ?>
	</body>
</html>