<?php

class UserController extends BaseController {

	public function loginPage() {
		return View::make('login');
	}

	public function login() {

	}

	public function signupPage() {
		return View::make('signup');
	}

	public function signup() {

	}

	public function logout() {
		Auth::logout();
		return Redirect::to('/');
	}

}
