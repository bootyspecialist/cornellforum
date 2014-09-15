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

Route::get('/', 'HomeController@homePage');

Route::get('page/{page_number}', function() {
	return View::make('home');
})->where('page_number', '[1-9]+');

Route::get('thread/{thread_id}/{slug?}', function() {
	return View::make('hello');
})->where('thread_id', '[1-9]+');

Route::get('new-thread', function() {
	return 0;
});

Route::post('new-thread', function() {
	return 0;
});

Route::post('comment', function() {
	return 0;
});

Route::get('frequently-asked-questions', function() {
	return 0;
});

Route::get('search', function() {
	return 0;
});

//Login and create account
Route::get('account/login', 'UserController@loginPage');
Route::post('account/login', 'UserController@login');
Route::get('account/signup', 'UserController@signupPage');
Route::post('account/login', 'UserController@login');
