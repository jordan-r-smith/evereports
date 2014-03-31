<?php
require_once 'config.php';

function logOn()
{
	if (isset($_POST['logon']))
	{
		$result = getDb() -> query('SELECT * FROM `user`');
		while ($row = $result -> fetch(PDO::FETCH_ASSOC))
		{
			if ($_POST['user_id'] == $row['id'] && $_POST['password'] == $row['password'])
			{
				$_SESSION['user_id'] = $row['id'];
				$msg = "Successfully logged in.";
			} else
			{
				$msg = "Incorrect username or password.";
			}
		}
	}
}

function registerAccount()
{
	if (isset($_POST['register']))
	{
		$insert = getDb() -> prepare('INSERT INTO `user` (`id`, `email`, `password`) VALUES (?, ?, ?)');
		$result = $insert -> execute(array($_POST['user_id'], $_POST['email'], $_POST['reg_password']));

		if ($result)
		{
			$_SESSION['user_id'] = $_POST['user_id'];
			unset($_POST);
			header("Location: index.php");
		} else
		{
			$msg = "Failed to register.";
		}
	}
}

function addAPI()
{
	global $msg;
	
	if (isset($_POST['add_api']))
	{
		$insert = getDb() -> prepare('INSERT INTO `api` (`id`, `keyID`, `vCode`) VALUES (?, ?, ?)');
		$result = $insert -> execute(array($_SESSION['user_id'], $_POST['keyID'], $_POST['vCode']));
		if ($result)
		{
			unset($_POST);
			header("Location: characters.php");
		} else
		{
			$msg = "Could not successfully add API key.";
		}
	}
}