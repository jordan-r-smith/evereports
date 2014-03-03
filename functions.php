<?php
function getDb()
{
	static $db;
	if (!$db)
	{
		$db = new PDO('mysql:host=localhost;dbname=evereports', 'root', '');
	}
	return $db;
}

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
				unset($_POST);
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
		$result = $insert -> execute(array($_POST['user_id'], $_POST['email'], $_POST['password']));

		if ($result)
		{
			$_SESSION['user_id'] = $_POST['user_id'];
			$msg = "Successfully registered for an account!";
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
	if (isset($_POST['add_api']))
	{
		if (!empty($_POST['keyID']) && !empty($_POST['vCode']))
		{
			$insert = getDb() -> prepare('INSERT INTO `api` (`id`, `keyID`, `vCode`) VALUES (?, ?, ?)');
			$result = $insert -> execute(array($_SESSION['user_id'], $_POST['keyID'], $_POST['vCode']));
			if ($result)
			{
				$msg = "API added to your account!";
				unset($_POST);
			} else
			{
				$msg = "Could not add API to your account.";
			}
		}
	}
}
