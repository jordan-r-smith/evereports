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
		<a href="api.php">Add API</a>
	</li>
	<li>
		<a href="characters.php">Characters</a>
	</li>
	<?php
	break;
	case 'api.php':
	?>
	<li>
		<a href="index.php">Home</a>
	</li>
	<li class="active">
		<a href="api.php">Add API</a>
	</li>
	<li>
		<a href="characters.php">Characters</a>
	</li>
	<?php
	break;
	case 'characters.php':
		#Same case for both pages
	case 'display.php':
	?>
	<li>
		<a href="index.php">Home</a>
	</li>
	<li>
		<a href="api.php">Add API</a>
	</li>
	<li class="active">
		<a href="characters.php">Characters</a>
	</li>
	<?php
	break;
	}
	?>
</ul>
<ul class="nav navbar-nav navbar-right">
	<li>
		<a href="logout.php">Logout (<?= $_SESSION['user_id'] ?>) <b class="glyphicon glyphicon-user"></b></a>
	</li>
</ul>