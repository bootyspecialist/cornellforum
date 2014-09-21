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

//Homepage and subsequent pages
Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@homePage'
));
Route::get('page/{page_number}', function() {
	return View::make('home');
})->where('page_number', '[1-9]+');

//threads
Route::get('thread/new', function() { return View::make('newthread'); });
Route::post('thread/new', 'ThreadController@newThread');
Route::get('thread/{thread_id}/{slug?}', array(
	'as' => 'thread',
	'uses' => 'ThreadController@viewThread'
))->where('thread_id', '[0-9]+');
Route::get('delete/thread/{thread_id}', array(
	'as' => 'delete_thread',
	'uses' => 'ThreadController@deleteThread'
))->where('thread_id', '[0-9]+');

//comments
Route::post('comment/{thread_id}/new', 'CommentController@newComment');

//voting
Route::get('vote/{thread_id}/up', 'VoteController@voteUp');
Route::get('vote/{thread_id}/down', 'VoteController@voteDown');

//vanity pages
Route::get('frequently-asked-questions', function() {
	return View::make('faq');
});

//search functions
Route::get('search', function() {
	return View::make('search');
});
Route::get('search/{query}', 'SearchController@search');

//profile page
Route::get('account', function() {
	return View::make('account');
});
Route::get('verification-sent', array('as' => 'verification-sent', function() {
	return View::make('verificationsent');
}));
