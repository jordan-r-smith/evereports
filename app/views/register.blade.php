@extends('master')

@section('navigation')

<ul class="nav navbar-nav">
	<li>
		{{ HTML::navLink("/", 'Home' ) }}
	</li>
	<li>
		{{ HTML::navLink("register", 'Register' ) }}
	</li>
</ul>
<ul class="nav navbar-nav navbar-right">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Log in <b class="caret"></b></a>
		<ul class="dropdown-menu" style="padding: 10px; min-width: 300px; background-color: #375a7f;">
			<li>
				<form action="" method="post" id="login" class="form-horizontal" role="form">
					<div class="form-group" style="margin: 10px;">
						<input type="text" placeholder="Username" class="form-control input-sm" name="user_id" id="user_id" required />
					</div>
					<div class="form-group" style="margin: 10px;">
						<input type="password" placeholder="Password" class="form-control input-sm" name="password" id="password" required />
					</div>
					<div class="form-group" style="margin: 10px;">
						<input type="checkbox" class="checkbox-inline" name="remember" id="remember" value="Remember" />
						<label for="remember">Keep me logged in</label>
					</div>
					<button type="submit" class="btn btn-default btn-sm" style="margin: 5px;" name="logon" id="logon">
						Sign in
					</button>
					<button type="submit" class="btn btn-default btn-sm" style="margin: 5px;" name="logon" id="logon">
						Forgot Username/Password
					</button>
				</form>
			</li>
		</ul>
	</li>
</ul>

@stop

@section('content')

@if (!isset($_SESSION['user_id']))
<div class="row">
	<div class="col-md-7">
		<h2>Why should you register?</h2>
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
			@if (!empty($msg))
				<h3>{{{ $msg }}}</h3>
			@endif
		</div>
	</div>
</div>
@else
	Redirect::route('home');
@endif

@stop