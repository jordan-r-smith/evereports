<!DOCTYPE html>
<html lang="en">
	<head>
		<title>EVE Reports</title>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="Jordan Smith">

		{{ HTML::style('assets/css/custom.style.css') }}
		{{ HTML::style('assets/css/darkly.min.css') }}
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
					<ul class="nav navbar-nav">
						<li>
							{{ HTML::navLink("/", 'Home') }}
						</li>
						@if(Auth::guest())
						<li>
							{{ HTML::navLink("register", 'Register') }}
						</li>
						@elseif(Auth::check())
						<li>
							{{ HTML::navLink("api", 'Add API') }}
						</li>
						<li>
							{{ HTML::navLink("characters", 'Characters') }}
						</li>
						@endif
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							@if(Auth::guest())
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Log in <b class="caret"></b></a>
							<ul class="dropdown-menu" style="padding: 10px; min-width: 300px; background-color: #375a7f;">
								<li>
									{{ Form::open(array('action' => 'UsersController@login', 'method' => 'POST', 'id' => 'login', 'class' => 'form-horizontal', 'role' => 'form')) }}
									<div class="form-group" style="margin: 10px;">
										<input type="text" placeholder="Username" class="form-control input-sm" name="username" id="username" required />
									</div>
									<div class="form-group" style="margin: 10px;">
										<input type="password" placeholder="Password" class="form-control input-sm" name="password" id="password" required />
									</div>
									<div class="form-group" style="margin: 10px;">
										<input type="checkbox" class="checkbox-inline" name="remember" id="remember" value="remember" />
										<label for="remember">Keep me logged in</label>
									</div>
									<button type="submit" class="btn btn-default btn-sm" style="margin: 5px;" name="logon" id="logon">
										Sign in
									</button>
									<button type="submit" class="btn btn-default btn-sm" style="margin: 5px;" name="logon" id="logon">
										Forgot Username/Password
									</button>
									{{ Form::close() }}
								</li>
							</ul>
							@elseif(Auth::check())
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->username }} <span class="glyphicon glyphicon-user"></span> <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li>
									{{ link_to_route('account', 'Account') }}
								</li>
								<li>
									{{ link_to_route('logout', 'Logout') }}
								</li>
							</ul>
							@endif
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="jumbotron">
			<div class="container">
				<header>
					<a href="/"><img src="assets/img/banner.jpg" class="img-responsive" alt="EVE Reports" /></a>
				</header>
			</div>
		</div>
		<div class="container">
			@if(Session::has('alert'))
			<div class="alert alert-dismissable {{ Session::get('alert-class') }}">
				<button type="button" class="close" data-dismiss="alert">×</button>
				{{ Session::get('alert') }}
			</div>
			@endif
			@yield('content')
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
		<script src="assets/js/jquery-validate.bootstrap-tooltip.min.js"></script>
		<script src="assets/js/form.validate.js"></script>
		<script src="assets/js/collapse.js"></script>
		<script type="text/javascript">
			$('[data-toggle="tooltip"]').tooltip({
				'placement' : 'bottom'
			});	
		</script>
		@include('confirm_delete')
	</body>
</html>