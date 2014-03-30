<?php
require_once 'functions.php';

session_start();

if (isset($_SESSION['user_id']))
{
	$insert = getDb() -> prepare('DELETE FROM `api` WHERE `id` = ? AND `keyID` = ?');
	$result = $insert -> execute(array($_SESSION['user_id'], $_GET['keyID']));
	if ($result)
	{
		header("Location: characters.php");
	} else
	{
		$msg = "Could not successfully remove API key.";
	}
}
