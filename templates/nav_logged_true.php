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