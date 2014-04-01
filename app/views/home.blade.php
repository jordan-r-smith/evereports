@extends('master')

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
				Current Pilots: <em class='text-info'>{{{ number_format($serverStatus -> onlinePlayers) }}}</em>
			</p>
		</div>
	</div>
</div>

@stop