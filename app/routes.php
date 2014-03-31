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

Route::get('/', 'PhealController@serverStatus');

Route::get('/register', function()
{
	return View::make('register');
});

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