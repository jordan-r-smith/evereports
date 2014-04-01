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

# Register - Only accessible to guests
Route::get('register', function()
{
	return View::make('register');
}) -> before('guest');

# Register - Create account
Route::post('register', 'UsersController@createAccount');

# Logout - Only accessible to registered users
Route::get('logout', array(
	'as' => 'logout',
	'uses' => 'UsersController@logout'
)) -> before('auth');

# API - Only accessible to registered users
Route::get('api', array(
	'as' => 'api',
	function()
	{
		return View::make('api');
	}

)) -> before('auth');

# API - Add API key
Route::post('api', 'APIKeyController@addAPIKey');

# Characters - Only accessible to registered users
Route::get('characters', 'APIKeyController@getAPIKeys') -> before('auth');

# Account - Only accessible to registered users
Route::get('account', array(
	'as' => 'account',
	function()
	{
		return View::make('account');
	}

)) -> before('auth');
