<?php

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

class APIKeyController extends BaseController
{

	public function addAPIKey()
	{
		$username = Auth::user() -> username;
		$keyID = Input::get('keyID');
		$vCode = Input::get('vCode');

		try
		{
			$accountRequest = new Pheal($keyID, $vCode, 'account');
			$accountRequest -> detectAccess();
			$apiKeyInfo = $accountRequest -> APIKeyInfo();
			
			$api_key_data = array(
				'keyID' => $keyID,
				'vCode' => $vCode,
				'username' => $username,
				'created_at' => new DateTime,
				'updated_at' => new DateTime
			);

			DB::table('apiKeys') -> insert($api_key_data);

			return Redirect::route('home') -> with(array(
				'alert' => 'You have successfully added an API key to your account!',
				'alert-class' => 'alert-success'
			));
		} catch (\Pheal\Exceptions\PhealException $e)
		{
			return Redirect::route('api') -> with(array(
				'alert' => 'Error: ' . get_class($e) . ' Message: ' . $e->getMessage(),
				'alert-class' => 'alert-danger'
			));
		}
	}
	
	public function getAPIKeys()
	{
		$username = Auth::user() -> username;
		
		$keys = DB::table('apiKeys') -> select('keyID', 'vCode') -> where('username', $username) -> get();
		return View::make('characters', array('apiKeys' => $keys));
	}

}
