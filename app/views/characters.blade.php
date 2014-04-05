@extends('master')

@section('content')

<div class="row">
	@foreach($apiKeys as $apiKey)
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="dropdown pull-right">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-wrench"></span> </a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="">Manage</a>
						</li>
						<li>
							<a href="" id="delete"
							data-toggle="modal"
							data-target="#confirmDelete"
							data-url="/characters/remove/{{ $apiKey -> keyID }}">Delete</a>
						</li>
					</ul>
				</div>
				<h3 class="panel-title">API ID {{ $apiKey -> keyID }}: </h3>
			</div>
			<ul class="characterList panel-body text-center">
				@foreach($apiKey -> charList as $character)
				<li>
					<a href='/characters/{{ $apiKey -> keyID }}/{{ $character -> name }}' role='button' class='thumbnail' data-toggle='tooltip' title='{{ $character -> name }}'>
						<img src='http://image.eveonline.com/Character/{{ $character -> characterID }}_128.jpg' alt='{{ $character -> name }}' />
					</a>
				</li>
				@endforeach
			</ul>
		</div>
	</div>
	@endforeach
</div>
<script type="text/javascript">
	$('[data-toggle="tooltip"]').tooltip({
		'placement' : 'bottom'
	}); 
</script>

@stop