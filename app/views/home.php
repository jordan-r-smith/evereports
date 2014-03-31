<?php
require_once 'functions.php';
require_once 'vendor/autoload.php';

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

session_start();
logOn();

$pheal = new Pheal();
$response = $pheal -> serverScope -> ServerStatus();
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
			<div class="row">
				<div class="col-md-8">
					<h2>What is EVE Reports?</h2>
					<p>
						EVE Reports is a tool that you can use to view and access your Characters' information from anywhere.  EVE Reports
						currently allows you to view your Character Sheet for any character of an account you add to your profile via the EVE API.
					</p>
					<h2>The Future</h2>
					<p>
						Eventually, a personal killboard is going to be implemented so that you can view and share your personal kills and losses online.
						There will also be wallet, asset, mail, and market tracking at some point.
					</p>
				</div>
				<div class="col-md-4">
					<div class="well">
						<h3>EVE Server Status</h3>
						<p>
							<?php
							echo sprintf("Tranquility: %s", $response -> serverOpen ? '<em class="text-success">Online</em>' : '<em class="text-danger">Offline</em>');
							?>
						</p>
						<h3>Player Count</h3>
						<p>
							<?php
							echo sprintf("Current Pilots: <em class='text-info'>%s</em>", number_format($response -> onlinePlayers));
							?>
						</p>
					</div>
				</div>
			</div>
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