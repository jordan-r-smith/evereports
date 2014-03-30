<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="label label-default" id="collapse-init">
			Expand all groups <span class="glyphicon glyphicon-resize-full"></span>
		</div>
		<div class="panel-group" id="accordion">
			<?php
			# Select list of skill groups from database
			try {
				$selectGroup = getDb() -> prepare('SELECT `groupName`, `groupID` FROM `invGroups` WHERE `categoryID` = ?');
				$selectGroup -> execute(array(16));
				$groupList = $selectGroup -> fetchAll(PDO::FETCH_ASSOC);
				asort($groupList);
			} catch (PDOException $e) {
				echo "";
			}
			
			# Create a table of the character's skills for each skill group
			foreach ($groupList as $group) :
				# Select list of skills that apply to a group
				try {
					$selectType = getDb()->prepare('SELECT `typeID`,`groupID`,`typeName` FROM `invTypes` WHERE `groupID` = ?');
					$selectType->execute(array($group['groupID']));
					$skillList = $selectType->fetchAll(PDO::FETCH_ASSOC);
					asort($skillList);
				} catch (PDOException $e) {
					echo $e;
				}
				
				# Create an associate array with all relavent information
				$skillsInGroup = array();
				foreach ($skillList as $groupSkill) {
					$groupTypeID = $groupSkill['typeID'];
					$groupTypeName = $groupSkill['typeName'];
					foreach ($skills as $skill) {
						$typeID = $skill['typeID'];
						$skillPoints = $skill['skillpoints'];
						$skillLevel = $skill['level'];
						if ($typeID == $groupTypeID) {
							$tempSkill = array(
								'typeName' => $groupTypeName,
								'skillPoints' => $skillPoints,
								'skillLevel' => $skillLevel
							);
							array_push($skillsInGroup, $tempSkill);
						}
					}
				}
				
				# Display groups with available skills
				if (!empty($skillsInGroup)) :
					$groupNameClass = str_replace(' ', '', $group['groupName']);
				?>
					<div class="panel panel-primary">
						<div class="panel-heading" data-toggle="collapse" data-target="#collapse<?= $groupNameClass ?>">
							<h3 class="panel-title">
								<span class="glyphicon glyphicon-th-list"></span> &nbsp; <?= $group['groupName'] ?> <small><?= count($skillsInGroup); ?> Skills</small>
							</h3>
						</div>
						<div id="collapse<?= $groupNameClass ?>" class="panel-collapse collapse in">
							<div class="panel-body">
								<table class="table table-bordered table-condensed table-striped">
									<?php
									foreach ($skillsInGroup as $skill) :
										$skillName = $skill['typeName'];
										$skillPoints = $skill['skillPoints'];
										$skillLevel = $skill['skillLevel'];
									?>
										<tr>
											<td><?= $skillName; ?></td>
											<td width="150px"><em><?= number_format($skillPoints); ?> SP</em></td>
											<td align="right" width="100px"><img src="assets/img/level<?= $skillLevel; ?>.jpg" /></td>
										</tr>
									<?php
											endforeach;
									?>
								</table>
							</div>
						</div>
					</div>
			<?php
						endif;
						endforeach;
			?>
		</div>
	</div>
</div>