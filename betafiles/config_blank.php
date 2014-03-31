<?php

$host = "localhost";
$dbname = "";
$username = "";
$password = "";

function getDb()
{
	static $db;
	if (!$db)
	{
		try
		{
			$db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
		} catch(PDOException $ex)
		{
			die("Failed to connect to the database");
		}
	}
	return $db;
}