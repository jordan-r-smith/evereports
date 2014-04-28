<?php

/*
 * Controller for users
 * 
 */
class UsersController extends BaseController {
  
  // Login a user
  public function login() {
    $user_data = array(
      'username' => Input::get('username'),
      'password' => Input::get('password')
    );

    if (Auth::attempt($user_data, Input::has('remember'))) {
      return Redirect::route('home') -> with(array(
        'alert-message' => 'You are successfully logged in.',
        'alert-class' => 'alert-success'
      ));
    }
    return Redirect::route('login') -> with(array(
      'alert-message' => 'Your username/password combination was incorrect.',
      'alert-class' => 'alert-danger'
    )) -> withInput();
  }

  // Logout a user
  public function logout() {
    Auth::logout();
    return Redirect::route('home') -> with(array(
      'alert-message' => 'You are successfully logged out.',
      'alert-class' => 'alert-success'
    ));
  }

  // Register a new user
  public function create() {
    $username = Input::get('reg_username');
    $email = Input::get('email');
    $password = Input::get('reg_password');
    $confirm_password = Input::get('confirm_password');

    // Make sure that both passwords are identical
    if (strcmp($password, $confirm_password) == 0) {
      $hashed_password = Hash::make($password);
      try {
        $user = new User;
        $user -> username = $username;
        $user -> email = $email;
        $user -> password = $hashed_password;
        $user -> save();
      } catch (\Illuminate\Database\QueryException $e) {
        return Redirect::route('register') -> with(array(
          'alert-message' => 'Error: Failed to register user in database.',
          'alert-class' => 'alert-danger'
        ));
      }

      // Login the new user automatically
      $user = User::where('username', '=', $username) -> first();
      Auth::login($user);

      return Redirect::route('home') -> with(array(
        'alert-message' => 'Welcome! You have successfully created an account, and have been logged in.',
        'alert-class' => 'alert-success'
      ));
    }

    return Redirect::route('register') -> with(array(
      'alert-message' => 'The attempt to create an account was unsuccessful!',
      'alert-class' => 'alert-danger'
    ));
  }

  // Update account information
  public function save() {
    $user = Auth::user();
    $email = Input::get('email');
    $password = Input::get('password');
    $confirm_password = Input::get('confirm_password');

    // Only update the password if the fields are not empty
    if (!empty($password)) {
      if (strcmp($password, $confirm_password) == 0) {
        $hashed_password = Hash::make($password);
        $user -> password = $hashed_password;
      } else {
        return Redirect::route('account') -> with(array(
          'alert' => 'Error: Passwords do not match!',
          'alert-class' => 'alert-danger'
        ));
      }
    }

    $user -> email = $email;
    $user -> save();

    return Redirect::route('home') -> with(array(
      'alert-message' => 'You have successfully updated your account information.',
      'alert-class' => 'alert-success'
    ));
  }

}
