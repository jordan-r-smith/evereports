<?php

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

class PhealController extends BaseController 
{
	
	public function serverStatus() 
	{
		$pheal = new Pheal();
		$response = $pheal -> serverScope -> ServerStatus();
		return View::make('home', array('serverStatus' => $response));
	}
	
}
