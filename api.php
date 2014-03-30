<?php
require_once 'functions.php';
require_once 'vendor/autoload.php';

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

session_start();
logOn();
addAPI();
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
				<div class="col-md-7">
					<h2>What is an API key?</h2>
					<p>
						The API key is a private code that identifies your account. Combined with your user ID, this key allows
						third party programs and web sites to access information about your characters and corporations. Using
						this data, such utilities can improve your EVE experience by providing useful functionality such as wallet
						exports, skill training notifications, and other tools.
					</p>
					<div class="well">
						<a href="https://api.eveonline.com/" target="_blank"> Create new API key </a>
					</div>
				</div>
				<div class="col-md-5">
					<div class="well">
						<h3>Add an API key</h3>
						<form action="" method="post" id="addapi" class="form-horizontal" role="form">
							<div class="form-group" style="margin: 10px;">
								<label for="keyID">Key ID: </label>
								<input type="text" placeholder="keyID" class="form-control input-sm" name="keyID" id="keyID" required/>
							</div>
							<div class="form-group" style="margin: 10px;">
								<label for="vCode">Verification Code: </label>
								<input type="text" placeholder="vCode" class="form-control input-sm" name="vCode" id="vCode" required />
							</div>
							<button type="submit" class="btn btn-default btn-sm" style="margin: 5px;" name="add_api" id="add_api">
								Add API
							</button>
						</form>
						<?php if (!empty($msg)): ?>
						<h3><?php echo $msg; ?></h3>
						<?php endif; ?>
					</div>
				</div>
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
	</body>
</html>