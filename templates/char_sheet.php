<div class="row">
	<div class="col-md-6 col-md-offset-1 text-center">
		<div class="well">
			<table class="table table-responsive">
				<tr>
					<td>
						<h2><?= $charSheetData['name']; ?></h2>
						<a href="https://zkillboard.com/character/<?= $charSheetData['characterID']; ?>" class="thumbnail" target="_blank">
							<img src="http://image.eveonline.com/Character/<?= $charSheetData['characterID']; ?>_256.jpg" alt="<?= $charSheetData['name']; ?>" />
						</a>
					</td>
					<td>
						<?php if (!empty($charSheetData['allianceName'])) { ?>
							<h5>Alliance:</h5>
							<h4><?= $charSheetData['allianceName']; ?></h4>
							<a href="https://zkillboard.com/alliance/<?= $charSheetData['allianceID']; ?>" class="thumbnail" target="_blank">
								<img src="http://image.eveonline.com/Alliance/<?= $charSheetData['allianceID']; ?>_64.png" alt="<?= $charSheetData['allianceName']; ?>" />
							</a>
						<?php } ?>
						<h5>Corporation:</h5>
						<h4><?= $charSheetData['corporationName']; ?></h4>
						<a href="https://zkillboard.com/corporation/<?= $charSheetData['corporationID']; ?>" class="thumbnail" target="_blank">
							<img src="http://image.eveonline.com/Corporation/<?= $charSheetData['corporationID']; ?>_64.png" alt="<?= $charSheetData['corporationName']; ?>" />
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
						<td><?= $charSheetData['DoB']; ?></td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Race:</strong>
						</td>
						<td><?= $charSheetData['race']; ?></td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Bloodline:</strong>
						</td>
						<td><?= $charSheetData['bloodLine']; ?></td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Ancestry:</strong>
						</td>
						<td><?= $charSheetData['ancestry']; ?></td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Clone:</strong>
						</td>
						<td><?= $charSheetData['cloneName']; ?></td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Total Skillpoints:</strong>
						</td>
						<td><?= number_format($totalSP); ?></td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Wealth:</strong>
						</td>
						<td><?= number_format($charSheetData['balance']) . " ISK"; ?></td>
					</tr>
					<tr>
						<td class="text-right">
							<strong>Security Status:</strong>
						</td>
						<td><?= number_format($charInfoData['securityStatus'], 2); ?></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>