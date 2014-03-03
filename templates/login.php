<?php if (!empty($msg)): ?>
<h3><?php echo $msg; ?></h3>
<?php endif; ?>
<form action="" method="post" id="login">
	<label for="user_id">Username: </label>
	<input type="text" name="user_id" id="user_id" required /><br />
	<label for="password">Password: </label>
	<input type="password" name="password" id="password" required /><br />
	<input type="submit" name="logon" id="submit" />
</form>