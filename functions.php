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

function genRandName($length)
{
	$characters = "abcdefghijklmnopqrstuvwxyzABCDERFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$randomString = "";
	for ($i = 0; $i < $length; $i++)
	{
		$randomString .= $characters[mt_rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}

