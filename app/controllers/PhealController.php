<?php

use Pheal\Pheal;
use Pheal\Core\Config;

Config::getInstance() -> cache = new \Pheal\Cache\FileStorage('cache/');
Config::getInstance() -> access = new \Pheal\Access\StaticCheck();

class PhealController extends BaseController {

  public function serverStatus() {
    $api_request = new Pheal();
    $response = $api_request -> serverScope -> ServerStatus();

    return View::make('home', array('serverStatus' => $response));
  }

  public static function charList($apiKey) {
    $keyID = $apiKey -> keyID;
    $vCode = $apiKey -> vCode;

    try {
      $api_request = new Pheal($keyID, $vCode, 'account');
      $api_request -> detectAccess();
      $char_list = $api_request -> Characters();
      $char_list = $char_list -> characters;

      return $char_list;
    } catch (\Pheal\Exceptions\PhealException $e) {
      return "Account: No Access";
    }
  }

  public function charSheet($apiKey, $charID) {
    $keyID = $apiKey -> keyID;
    $vCode = $apiKey -> vCode;

    try {
      $charRequest = new Pheal($keyID, $vCode, 'char');
      $charRequest -> detectAccess();

      $arguments = array('characterID' => $charID);
      $char_sheet = $charRequest -> CharacterSheet($arguments);

      $charSheetData = $char_sheet -> toArray();
      if (isset($charSheetData['result'])) {
        $charSheetData = $charSheetData['result'];
      }

      return $charSheetData;
    } catch (\Pheal\Exceptions\PhealException $e) {
      return "CharacterSheet: No Access";
    }
  }

  public function skills($apiKey, $charID) {
    $keyID = $apiKey -> keyID;
    $vCode = $apiKey -> vCode;

    try {
      $charRequest = new Pheal($keyID, $vCode, 'char');
      $charRequest -> detectAccess();

      $arguments = array('characterID' => $charID);
      $char_sheet = $charRequest -> CharacterSheet($arguments);

      $skills = $char_sheet -> skills -> toArray();

      return $skills;
    } catch (\Pheal\Exceptions\PhealException $e) {
      return "CharacterSheet: No Access";
    }
  }

  public function charInfo($apiKey, $charID) {
    $keyID = $apiKey -> keyID;
    $vCode = $apiKey -> vCode;

    try {
      # CharacterInfo API Function
      $eveRequest = new Pheal($keyID, $vCode, 'eve');
      $eveRequest -> detectAccess();

      $arguments = array('characterID' => $charID);
      $char_info = $eveRequest -> CharacterInfo($arguments);

      $charInfoData = $char_info -> toArray();
      if (isset($charInfoData['result'])) {
        $charInfoData = $charInfoData['result'];
      }

      return $charInfoData;
    } catch (\Pheal\Exceptions\PhealException $e) {
      return "CharacterInfo (Private): No Access";
    }
  }

  public function getCharID($apiKey, $charName) {
    $keyID = $apiKey -> keyID;
    $vCode = $apiKey -> vCode;

    try {
      $eveRequest = new Pheal($keyID, $vCode, 'eve');
      $eveRequest -> detectAccess();

      $arguments = array('names' => $charName);
      $char_info = $eveRequest -> CharacterID($arguments);

      $charID = $char_info -> characters[0] -> characterID;

      return $charID;
    } catch (\Pheal\Exceptions\PhealException $e) {
      return "CharacterID: No Access";
    }
  }

  public function skillQueue($apiKey, $charID) {
    $keyID = $apiKey -> keyID;
    $vCode = $apiKey -> vCode;

    try {
      $charRequest = new Pheal($keyID, $vCode, 'char');
      $charRequest -> detectAccess();

      $arguments = array('characterID' => $charID);
      $queueRequest = $charRequest -> SkillQueue($arguments);

      $skillQueue = $queueRequest -> skillqueue -> toArray();

      return $skillQueue;
    } catch (\Pheal\Exceptions\PhealException $e) {
      return "SkillQueue: No Access";
    }
  }

  public function displayChar($keyID, $charName) {
    $apiKey = APIKeyController::getKey($keyID);
    $charID = $this -> getCharID($apiKey, $charName);

    $charSheet = $this -> charSheet($apiKey, $charID);
    $skills = $this -> skills($apiKey, $charID);
    $charInfo = $this -> charInfo($apiKey, $charID);
    $skillQueue = $this -> skillQueue($apiKey, $charID);

    $totalSP = 0;

    if (gettype($skills) != "string") {
      foreach ($skills as $skill) {
        $skillPoints = $skill['skillpoints'];
        $totalSP = $totalSP + $skillPoints;
      }
    }

    return View::make('characters.display', array(
      'charSheet' => $charSheet,
      'skills' => $skills,
      'totalSP' => $totalSP,
      'charInfo' => $charInfo,
      'skillQueue' => $skillQueue
    ));
  }

}
