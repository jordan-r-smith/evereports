<div class="row">
	<div class="col-md-4 text-center">
		<div class="list-group">
			<div class="list-group-item">
				<div class="list-group-item-heading">
					<h1><?= $data['name']; ?></h1>
				</div>
				<div class="list-group-item-text">
					<a href="https://zkillboard.com/character/<?= $data['characterID']; ?>" class="thumbnail" target="_blank">
						<img src="http://image.eveonline.com/Character/<?= $data['characterID']; ?>_256.jpg" alt="<?= $data['name']; ?>" />
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4 text-center">
		<div class="list-group">
			<?php if (!empty($data['allianceName'])) { ?>
				<div class="list-group-item">
					<div class="list-group-item-heading">
						<h2><?= $data['allianceName']; ?></h2>
					</div>
					<div class="list-group-item-text">
						<a href="https://zkillboard.com/alliance/<?= $data['allianceID']; ?>" class="thumbnail" target="_blank">
							<img src="http://image.eveonline.com/Alliance/<?= $data['allianceID']; ?>_128.png" alt="<?= $data['allianceName']; ?>" />
						</a>
					</div>
				</div>
			<?php } ?>
			<div class="list-group-item">
				<div class="list-group-item-heading">
					<h2><?= $data['corporationName']; ?></h2>
				</div>
				<div class="list-group-item-text">
					<a href="https://zkillboard.com/corporation/<?= $data['corporationID']; ?>" class="thumbnail" target="_blank">
						<img src="http://image.eveonline.com/Corporation/<?= $data['corporationID']; ?>_128.png" alt="<?= $data['corporationName']; ?>" />
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2>Stats</h2>
			</div>
			<div class="panel-body">
				<table class="table table-responsive">
					<thead>
						<tr>
							<th>Property</th>
							<th>Value</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Bloodline</td>
							<td><?= $data['bloodLine']; ?></td>
						</tr>
						<tr>
							<td>Ancestry</td>
							<td><?= $data['ancestry']; ?></td>
						</tr>
						<tr>
							<td>Clone</td>
							<td><?= $data['cloneName']; ?></td>
						</tr>
						<tr>
							<td>Total Skillpoints</td>
							<td><?= number_format($totalSP); ?></td>
						</tr>
						<tr>
							<td>Wealth</td>
							<td><?= number_format($data['balance']) . " ISK"; ?></td>
						</tr>
						<tr>
							<td>Gender</td>
							<td><?= $data['gender']; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>