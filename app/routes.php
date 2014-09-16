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

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@homePage'));

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

//Vanity pages
Route::get('frequently-asked-questions', function() {
	return View::make('faq');
});

//Search functions
Route::get('search', 'SearchController@searchPage');
Route::get('search/{query}', 'SearchController@search');
