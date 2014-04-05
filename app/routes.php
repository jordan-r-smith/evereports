<?php

/*
 |--------------------------------------------------------------------------
 | Application Routes
 |--------------------------------------------------------------------------
 |
 | Here is where you can register all of the routes for an application.
 | It's a breeze. Simply tell Laravel the URIs it should respond to
 | and give it the Closure to execute when that URI is requested.
 |
 */

# Active class added to link in nav that conincides with current view
HTML::macro('navLink', function($route, $text)
{
	if (Request::path() == $route)
	{
		$active = "class = 'active'";
	} else
	{
		$active = '';
	}

	return '<li ' . $active . '>' . link_to($route, $text) . '</li>';
});

# User model
Route::model('user', 'User');

# APIKey model
Route::model('apiKey', 'APIKey');

# Home - Uses Pheal library
Route::get('/', array(
	'as' => 'home',
	'uses' => 'PhealController@serverStatus'
));

# Home - Login
Route::post('/', array(
	'as' => 'login',
	'uses' => 'UsersController@login'
));

# Guests only
Route::group(array('before' => 'guest'), function()
{
	# Register
	Route::get('register', function()
	{
		return View::make('register');
	});

	# Register - Create account
	Route::post('register', 'UsersController@createAccount');

});

# Registered users only
Route::group(array('before' => 'auth'), function()
{
	# Logout
	Route::get('logout', array(
		'as' => 'logout',
		'uses' => 'UsersController@logout'
	));

	# API - View
	Route::get('api', array(
		'as' => 'api',
		function()
		{
			return View::make('api');
		}

	));

	# API - Add API key to database
	Route::post('api', 'APIKeyController@addAPIKey');

	# Characters - Generate API/character list
	Route::get('characters', array(
		'as' => 'characters',
		'uses' => 'APIKeyController@listAPIKeys'
	));

	# Characters - Delete API key from database
	Route::get('characters/remove/{keyID}', array(
		'as' => 'removeAPI',
		'uses' => 'APIKeyController@removeAPIKey'
	));

	# Characters - Display character
	Route::get('characters/{keyID}/{charName}', 'PhealController@displayChar');

	# Account - View
	Route::get('account', array(
		'as' => 'account',
		function()
		{
			return View::make('account');
		}

	));
});
