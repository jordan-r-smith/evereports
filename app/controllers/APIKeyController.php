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
		} catch (\Pheal\Exceptions\PhealException $e)
		{
			return Redirect::route('api') -> with(array(
				'alert' => 'Error: Your API key is not valid or the API service is offline.',
				'alert-class' => 'alert-danger'
			));
		}
		try
		{
			$api_key_data = new APIKey;
			$api_key_data -> keyID = $keyID;
			$api_key_data -> vCode = $vCode;
			$api_key_data -> username = $username;
			$api_key_data -> save();
		} catch (\Illuminate\Database\QueryException $e)
		{
			return Redirect::route('api') -> with(array(
				'alert' => 'Error: API key is already in the database. If it is not on your account, delete/remove the API key and create a new one.',
				'alert-class' => 'alert-danger'
			));
		}
		return Redirect::route('characters') -> with(array(
			'alert' => 'You have successfully added an API key to your account!',
			'alert-class' => 'alert-success'
		));
	}

	public function removeAPIKey($keyID)
	{
		try
		{
			$key = APIKey::where('keyID', $keyID) -> delete();
		} catch (\Illuminate\Database\QueryException $e)
		{
			return Redirect::route('characters') -> with(array(
				'alert' => 'Error: Fail to remove API key from the server. Please contact support.',
				'alert-class' => 'alert-danger'
			));
		}
		return Redirect::route('characters') -> with(array(
			'alert' => 'You have successfully removed an API Key.',
			'alert-class' => 'alert-success'
		));

	}

	public function getAPIKeys()
	{
		$username = Auth::user() -> username;
		$keys = APIKey::select('keyID', 'vCode') -> where('username', $username) -> get();

		foreach ($keys as $key)
		{
			$charList = PhealController::characterList($key);
			$key -> charList = $charList;
		}

		return View::make('characters', array('apiKeys' => $keys));
	}

}