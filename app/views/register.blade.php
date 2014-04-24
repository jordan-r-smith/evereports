@extends('master')

@section('content')

<div class="row">
	<div class="col-md-7">
		<h2>Why should you register?</h2>
		<p>
			You will be able to view your basic character information.  Your skill list will be displayed along with your current skill queue in a nice format.
			You will not only be able to add an API for a single account, but you can add an API for as many accounts as you wish.  
			Eventually we will add support for Mail, Assets, and a personal Killboard for each of your characters.
		</p>
	</div>
	<div class="col-md-5">
		<div class="well">
			<h3>Register for an Account!</h3>
			{{ Form::open(array('method' => 'POST', 'id' => 'registration', 'class' => 'form-horizontal', 'role' => 'form')) }}
				<div class="form-group" style="margin: 10px;">
					<label for="username">Username: </label>
					<input type="text" placeholder="Username" class="form-control input-sm" name="reg_username" id="reg_username" required />
				</div>
				<div class="form-group" style="margin: 10px;">
					<label for="email">Email: </label>
					<input type="email" placeholder="Email" class="form-control input-sm" name="email" id="email" required />
				</div>
				<div class="form-group" style="margin: 10px;">
					<label for="reg_password">Password: </label>
					<input type="password" placeholder="Password" class="form-control input-sm" name="reg_password" id="reg_password" required />
				</div>
				<div class="form-group" style="margin: 10px;">
					<label for="confirm_password">Confirm Password: </label>
					<input type="password" placeholder="Confirm Password" class="form-control input-sm" name="confirm_password" id="confirm_password" required />
				</div>
				<button type="submit" class="btn btn-default btn-sm" style="margin: 5px;" name="register" id="register">
					Create Account
				</button>
			{{ Form::close() }}
		</div>
	</div>
</div>

@stop