<?php

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

/*
 * Controller for API Keys
 *
 */
class APIKeyController extends BaseController {

  // Save an API Key
  public function add() {
    $username = Auth::user() -> username;
    $keyID = Input::get('keyID');
    $vCode = Input::get('vCode');

    try {
      $accountRequest = new Pheal($keyID, $vCode, 'account');
      $accountRequest -> detectAccess();
      $apiKeyInfo = $accountRequest -> APIKeyInfo();
    } catch (\Pheal\Exceptions\PhealException $e) {
      return Redirect::route('api') -> with(array(
        'alert-message' => 'Error: Your API key is not valid or the API service is offline.',
        'alert-class' => 'alert-danger'
      ));
    }
    try {
      $api_key_data = new APIKey;
      $api_key_data -> keyID = $keyID;
      $api_key_data -> vCode = $vCode;
      $api_key_data -> username = $username;
      $api_key_data -> save();
    } catch (\Illuminate\Database\QueryException $e) {
      return Redirect::route('api') -> with(array(
        'alert-message' => 'Error: API key is already in the database. If it is not on your account, delete/remove the API key and create a new one.',
        'alert-class' => 'alert-danger'
      ));
    }
    return Redirect::route('characters') -> with(array(
      'alert-message' => 'You have successfully added an API key to your account!',
      'alert-class' => 'alert-success'
    ));
  }

  // Delete an API Key
  public function remove($keyID) {
    $username = Auth::user() -> username;
    $userDB = '';

    try {
      $userDB = APIKey::select('username') -> where('keyID', $keyID, 'AND') -> where('username', $username) -> first();
      $key = APIKey::where('keyID', $keyID, 'AND') -> where('username', $username) -> delete();
    } catch (\Illuminate\Database\QueryException $e) {
      return Redirect::route('characters') -> with(array(
        'alert-message' => 'Error: Failed to remove API key from the server. Please contact support.',
        'alert-class' => 'alert-danger'
      ));
    }

    if (!empty($userDB -> username)) {
      return Redirect::route('characters') -> with(array(
        'alert-message' => 'You have successfully removed an API Key.',
        'alert-class' => 'alert-success'
      ));
    } else {
      return Redirect::route('characters') -> with(array(
        'alert-message' => 'Error: You are attemping to remove an API key that does not belong to you!',
        'alert-class' => 'alert-danger'
      ));
    }

  }

  // Return a list of all API Keys related to the user
  public function getKeys() {
    try {
      $username = Auth::user() -> username;
      $keys = APIKey::select('keyID', 'vCode') -> where('username', $username) -> get();

      foreach ($keys as $key) {
        $charList = PhealController::charList($key);
        $key -> charList = $charList;
      }

      return View::make('characters.index', array('apiKeys' => $keys));
    } catch (\Illuminate\Database\QueryException $e) {
      return Redirect::route('characters') -> with(array(
        'alert-message' => 'Error: Could not retrieve API keys.',
        'alert-class' => 'alert-warning'
      ));
    }

  }

  // Return a single API Key related to the user
  public static function getKey($keyID) {
    try {
      $username = Auth::user() -> username;
      $apiKey = APIKey::where('keyID', $keyID, 'AND') -> where('username', $username) -> first();

      return $apiKey;
    } catch (\Illuminate\Database\QueryException $e) {
      return Redirect::route('characters') -> with(array(
        'alert-message' => 'Error: Could not retrieve API key ID.',
        'alert-class' => 'alert-warning'
      ));
    }
  }

}
