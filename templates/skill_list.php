<div class="row">
	<div class="col-md-6">
		<div class="well">
			<h2>Skills</h2>
			<table>
				<thead>
					<tr>
						<th>Name</th>
						<th>Skillpoints</th>
						<th>Level</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$selectType = getDb()->prepare('SELECT `typeName` AS `name` FROM `invTypes` WHERE `typeID` = ?');
					
					foreach ($skills as $skill) {
						$selectType->execute(array($skill['typeID']));
						$result = $selectType->fetchAll(PDO::FETCH_ASSOC);
						$skillName = $result[0]['name'];
						$skillPoints = $skill['skillpoints'];
						$totalSP = $totalSP + 1;
						$skillLevel = $skill['level'];
					?>
					<tr>
						<td><?php echo $skillName; ?></td>
						<td><?php echo $skillPoints; ?></td>
						<td><?php echo $skillLevel; ?></td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>