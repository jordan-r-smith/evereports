<?php

class UsersController extends BaseController
{
	public function login()
	{
		$user_data = array(
			'username' => Input::get('username'),
			'password' => Input::get('password')
		);
		
		if (Auth::attempt($user_data, Input::has('remember')))
		{
			return Redirect::route('home') -> with(array(
				'alert' => 'You are successfully logged in.',
				'alert-class' => 'alert-success'
			));
		}
		return Redirect::route('login') -> with(array(
			'alert' => 'Your username/password combination was incorrect.',
			'alert-class' => 'alert-danger'
		)) -> withInput();
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::route('home') -> with(array(
			'alert' => 'You are successfully logged out.',
			'alert-class' => 'alert-success'
		));
	}

	public function createAccount()
	{
		$username = Input::get('reg_username');
		$email = Input::get('email');
		$password = Input::get('reg_password');
		$confirm_password = Input::get('confirm_password');

		if (strcmp($password, $confirm_password) == 0)
		{
			$hashed_password = Hash::make($password);

			$user_data = array(
				'username' => $username,
				'email' => $email,
				'password' => $hashed_password,
				'created_at' => new DateTime,
				'updated_at' => new DateTime
			);

			DB::table('users') -> insert($user_data);

			$user = User::where('username', '=', $username) -> first();
			Auth::login($user);

			return Redirect::route('home') -> with(array(
				'alert' => 'Welcome! You have successfully created an account, and have been logged in.',
				'alert-class' => 'alert-success'
			));
		}

		return Redirect::route('register') -> with(array(
			'alert' => 'The attempt to create an account was unsuccessful!',
			'alert-class' => 'alert-danger'
		));
	}

}
