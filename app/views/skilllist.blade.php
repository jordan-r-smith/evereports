<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div class="label label-default" id="collapse-init">
		Expand all groups <span class="glyphicon glyphicon-resize-small"></span>
		</div>
		<div class="panel-group" id="accordion">
			<?php
			# Select list of skill groups from database
			try {
				$groupList = DB::table('invGroups') -> select('groupName', 'groupID') -> where('categoryID', 16) -> get();
				asort($groupList);
			} catch (PDOException $e) {
				echo "Error: invGroups";
			}
			 # Create a table of the character's skills for each skill group 
			?>
			@foreach ($groupList as $group)
				<?php
				# Select list of skills that apply to a group
				try {
					$skillList = DB::table('invTypes') -> select('typeID', 'groupID', 'typeName') -> where('groupID', $group -> groupID) -> get();
					asort($skillList);
				} catch (PDOException $e) {
					echo $e;
				}

				# Create an associate array with all relavent information
				$skillsInGroup = array();
				?>
				@foreach ($skillList as $groupSkill)
				<?php
				$groupTypeID = $groupSkill -> typeID;
				$groupTypeName = $groupSkill -> typeName;
				?>
					@foreach ($skills as $skill)
					<?php
					$typeID = $skill['typeID'];
					$skillPoints = $skill['skillpoints'];
					$skillLevel = $skill['level'];
					?>
						@if ($typeID == $groupTypeID)
						<?php
						$tempSkill = array(
							'typeName' => $groupTypeName,
							'skillPoints' => $skillPoints,
							'skillLevel' => $skillLevel
						);
						array_push($skillsInGroup, $tempSkill);
						?>
						@endif
					@endforeach
				@endforeach

				@if (!empty($skillsInGroup))
					<div class="panel panel-primary">
						<div class="panel-heading" data-toggle="collapse" data-target="#collapse{{ str_replace(' ', '', $group -> groupName) }}">
							<h3 class="panel-title">
								<span class="glyphicon glyphicon-th-list"></span> &nbsp; {{ $group -> groupName }} <small>{{ count($skillsInGroup) }} Skills</small>
							</h3>
						</div>
						<div id="collapse{{ str_replace(' ', '', $group -> groupName) }}" class="panel-collapse collapse in">
							<div class="panel-body">
								<table class="table table-bordered table-condensed table-striped">
									@foreach ($skillsInGroup as $skill)
										<tr>
											<td>{{ $skill['typeName'] }}</td>
											<td width="150px"><em>{{ number_format($skill['skillPoints']) }} SP</em></td>
											<td align="right" width="100px"><img src="{{ asset('assets/img/level' . $skill['skillLevel'] . '.jpg') }}" /></td>
										</tr>
									@endforeach
								</table>
							</div>
						</div>
					</div>
				@endif
			@endforeach
		</div>
	</div>
</div>
