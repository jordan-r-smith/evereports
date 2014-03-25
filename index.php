<?php
require_once 'functions.php';
require_once 'vendor/autoload.php';

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('.pheal/cache/');
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
		<link href="dist/css/darkly.min.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
	</head>
	<body>
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
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
					if (isset($_SESSION['user_id'])):
					include 'templates/nav_logged_true.php';
					?>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="logout.php">Logout <b class="glyphicon glyphicon-user"></b></a>
						</li>
					</ul>
					<?php else:
						include 'templates/nav_logged_false.php';
					?>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
							<ul class="dropdown-menu" style="padding: 10px; background-color: #375a7f;">
								<li>
									<?php
									include 'templates/login_form.php';
									?>
								</li>
							</ul>
						</li>
					</ul>
					<?php endif; ?>
				</div>
			</nav>
		</div>
		<div class="jumbotron">
			<div class="container">
				<header>
					<a href="index.php"><img src="i/banner.jpg" class="img-responsive" alt="EVE Reports" /></a>
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
				<div class="col-md-3 well">
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
			<hr/>
			<footer>
				<p>
					&copy; EVEReports.com 2014
				</p>
			</footer>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="dist/js/bootstrap.min.js"></script>
	</body>
</html>