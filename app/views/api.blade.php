@extends('master')

@section('content')

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
		</div>
	</div>
</div>

@stop