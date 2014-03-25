<?php
require_once 'functions.php';
require_once 'vendor/autoload.php';

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('.pheal/cache/');
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
				<div class="col-md-3">
					<div class="panel panel-default">
						<?php
						echo sprintf("<p class='panel-heading'>API ID %s:</p>", $row['keyID']);
						try
						{
							$request = new Pheal($row['keyID'], $row['vCode'], 'account');
							$request -> detectAccess();
							$char_list = $request -> Characters();
							echo "<ul class='characterList panel-body'>";
							foreach ($char_list->characters as $character)
							{
								echo sprintf("
									<li>
										<a href='display.php?charID=%s&amp;keyID=%s' role='button' class='btn btn-default btn-sm' data-toggle='tooltip' title='%s'>
											<img src='http://image.eveonline.com/Character/%s_128.jpg' alt='%s' />
										</a>
									</li>", $character -> characterID, $row['keyID'], $character -> name, $character -> characterID, $character -> name);
							}
							echo "</ul>";
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="dist/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$('[data-toggle="tooltip"]').tooltip({
				'placement' : 'right'
			});	
		</script>
	</body>
</html>