<?php
require_once 'functions.php';

session_start();
logOn();
registerAccount();

$msg = '';
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
			if (!isset($_SESSION['user_id'])):
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
				</div>
				<div class="col-md-5">
					<div class="well">
						<h3>Register for an Account!</h3>
						<form action="" method="post" id="registration" class="form-horizontal" role="form">
							<div class="form-group" style="margin: 10px;">
								<label for="user_id">Username: </label>
								<input type="text" placeholder="Username" class="form-control input-sm" name="user_id" id="user_id" required />
							</div>
							<div class="form-group" style="margin: 10px;">
								<label for="email">Email: </label>
								<input type="email" placeholder="Email" class="form-control input-sm" name="email" id="email" required />
							</div>
							<div class="form-group" style="margin: 10px;">
								<label for="reg_password">Password: </label>
								<input type="text" placeholder="Password" class="form-control input-sm" name="reg_password" id="reg_password" required />
							</div>
							<div class="form-group" style="margin: 10px;">
								<label for="confirm_password">Confirm Password: </label>
								<input type="text" placeholder="Confirm Password" class="form-control input-sm" name="confirm_password" id="confirm_password" required />
							</div>
							<button type="submit" class="btn btn-default btn-sm" style="margin: 5px;" name="register" id="register">
								Register
							</button>
						</form>
						<?php if (!empty($msg)):
						?>
						<h3><?php echo $msg; ?><
						/h3>
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
		<script src="assets/js/jquery.validate.min.js"></script>
		<script src="assets/js/additional-methods.min.js"></script>
		<script src="assets/js/jquery-validate.bootstrap-tooltip.min.js"></script>
		<script>
			$('#registration').validate({
				rules : {
					user_id : {
						required : true,
						minlength : 5
					},
					email : {
						required : true,
						email : true
					},
					reg_password : {
						required : true,
						minlength : 5
					},
					confirm_password : {
						required : true,
						minlength : 5,
						equalTo : "#reg_password"
					},
				},
				messages : {
					reg_password : {
						required : "Please provide a password",
						minlength : "Your password must be at least 5 characters long!"
					},
					confirm_password : {
						required : "Please provide a password",
						minlength : "Your password must be at least 5 characters long",
						equalTo : "Please enter the same password as above"
					}
				},
				tooltip_options: {
	    			user_id: { 
	    				placement: 'top'
	    			},
	    			email: { 
	    				placement: 'top'
	    			},
	    			reg_password: { 
	    				placement: 'top'
	    			},
	    			confirm_password: { 
	    				placement: 'top'
	    			}
	        	}
			});
		</script>
	</body>
</html>