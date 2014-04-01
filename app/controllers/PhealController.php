<?php

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

class PhealController extends BaseController
{

	public function serverStatus()
	{
		$api_request = new Pheal();
		$response = $api_request -> serverScope -> ServerStatus();

		return View::make('home', array('serverStatus' => $response));
	}

	public static function characterList($apiKey)
	{
		$keyID = $apiKey -> keyID;
		$vCode = $apiKey -> vCode;
		
		try
		{
			$api_request = new Pheal($keyID, $vCode, 'account');
			$api_request -> detectAccess();
			$char_list = $api_request -> Characters();
			
			//return View::make('characters', array('characterList' => $char_list));
			return $char_list;
		} catch (\Pheal\Exceptions\PhealException $e)
		{
			/*return View::make('characters') -> with(array(
				'alert' => 'Error: ' . get_class($e) . ' Message: ' . $e -> getMessage(),
				'alert-class' => 'alert-danger'
			));*/
		}
	}

}
