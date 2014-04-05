@extends('master')

@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-1 text-center">
		<div class="well">
			<table class="table table-responsive">
				<tr>
					<td>
						<h2>{{ $charSheet['name'] }}</h2>
						<a href="https://zkillboard.com/character/{{ $charSheet['characterID'] }}" class="thumbnail" target="_blank">
							<img src="http://image.eveonline.com/Character/{{ $charSheet['characterID'] }}_256.jpg" alt="{{ $charSheet['name'] }}" />
						</a>
					</td>
					<td>
						@if(!empty($charSheet['allianceName']))
							<h5>Alliance:</h5>
							<h4>{{ $charSheet['allianceName'] }}</h4>
							<a href="https://zkillboard.com/alliance/{{ $charSheet['allianceID'] }}" class="thumbnail" target="_blank">
								<img src="http://image.eveonline.com/Alliance/{{ $charSheet['allianceID'] }}_64.png" alt="{{ $charSheet['allianceName'] }}" />
							</a>
						@endif
						<h5>Corporation:</h5>
						<h4>{{ $charSheet['corporationName'] }}</h4>
						<a href="https://zkillboard.com/corporation/{{ $charSheet['corporationID'] }}" class="thumbnail" target="_blank">
							<img src="http://image.eveonline.com/Corporation/{{ $charSheet['corporationID'] }}_64.png" alt="{{ $charSheet['corporationName'] }}" />
						</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div class="col-md-4">
		<div class="well" style="height: 100% !important;">
			<table class="table table-bordered table-responsive" style="margin-bottom: 0;">
				<thead>
					<tr class="label-default">
						<th colspan="2" class="text-center ">
							<h2>Stats</h2>
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="text-right">
							<strong>DoB:</strong>
						</td>
						<td>{{ $charSheet['DoB'] }}</td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Race:</strong>
						</td>
						<td>{{ $charSheet['race'] }}</td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Bloodline:</strong>
						</td>
						<td>{{ $charSheet['bloodLine'] }}</td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Ancestry:</strong>
						</td>
						<td>{{ $charSheet['ancestry'] }}</td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Clone:</strong>
						</td>
						<td>{{ $charSheet['cloneName'] }}</td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Total Skillpoints:</strong>
						</td>
						<td>{{ number_format($totalSP) }}</td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Wealth:</strong>
						</td>
						<td>{{ number_format($charSheet['balance']) }} ISK</td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Security Status:</strong>
						</td>
						<td>{{ number_format($charInfo['securityStatus'], 2) }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@include('skilllist')

@stop