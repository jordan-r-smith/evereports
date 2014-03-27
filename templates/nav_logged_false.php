<ul class="nav navbar-nav">
	<?php 
	$baseName = basename($_SERVER['PHP_SELF']);
	switch ($baseName) {
		case 'index.php':
	?>
	<li class="active">
		<a href="index.php">Home</a>
	</li>
	<li>
		<a href="register.php">Register</a>
	</li>
	<?php
	break;
	case 'register.php':
	?>
	<li>
		<a href="index.php">Home</a>
	</li>
	<li class="active">
		<a href="register.php">Register</a>
	</li>
	<?php
	break;
	}
	?>
</ul>
<ul class="nav navbar-nav navbar-right">
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
		<ul class="dropdown-menu" style="padding: 10px; min-width: 300px; background-color: #375a7f;">
			<li>
				<form action="" method="post" id="login" class="form-horizontal" role="form">
					<div class="form-group" style="margin: 10px;">
						<input type="text" placeholder="Username" class="form-control input-sm" name="user_id" id="user_id" required />
					</div>
					<div class="form-group" style="margin: 10px;">
						<input type="password" placeholder="Password" class="form-control input-sm" name="password" id="password" required />
					</div>
					<button type="submit" class="btn btn-default btn-sm" style="margin: 5px;" name="logon" id="logon" />
					Sign in
					</button>
				</form>
			</li>
		</ul>
	</li>
</ul>