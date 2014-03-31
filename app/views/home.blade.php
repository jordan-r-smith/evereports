@extends('master')

@section('navigation')

<ul class="nav navbar-nav">
	<li>
		{{ HTML::navLink("/", 'Home' ) }}
	</li>
	<li>
		{{ HTML::navLink("/register", 'Register' ) }}
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
				Tranquility: 
				@if ($serverStatus -> serverOpen)
					<em class="text-success">Online</em>
				@else
					<em class="text-danger">Offline</em>
				@endif
			</p>
			<h3>Player Count</h3>
			<p>
				Current Pilots: <em class='text-info'>{{ number_format($serverStatus -> onlinePlayers) }}</em>
			</p>
		</div>
	</div>
</div>

@stop