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

//homepage
Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@homePage'
));

//threads
Route::get('thread/new', array(
	'as' => 'new_thread_form',
	'before' => 'Sentinel\auth',
	'uses' => 'ThreadController@newThreadForm'
));
Route::post('thread/new', array(
	'as' => 'post_new_thread',
	'before' => 'Sentinel\auth',
	'uses' => 'ThreadController@newThread',
));
Route::get('thread/{thread_id}/{slug?}', array(
	'as' => 'thread',
	'uses' => 'ThreadController@viewThread'
))->where('thread_id', '[0-9]+');
Route::get('delete/thread/{thread_id}', array(
	'as' => 'delete_thread',
	'before' => 'Sentinel\auth',
	'uses' => 'ThreadController@deleteThread'
))->where('thread_id', '[0-9]+');
Route::get('quote/thread/{thread_id}', array(
	'as' => 'quote_thread',
	'before' => 'Sentinel\auth',
	'uses' => 'ThreadController@quoteThread'
))->where('thread_id', '[0-9]+');

//comments
Route::post('comment/{thread_id}/new', array(
	'as' => 'post_new_comment',
	'before' => 'Sentinel\auth',
	'uses' => 'CommentController@newComment'
))->where('thread_id', '[0-9]+');
Route::get('delete/comment/{comment_id}', array(
	'as' => 'delete_comment',
	'before' => 'Sentinel\auth',
	'uses' => 'CommentController@deleteComment'
))->where('comment_id', '[0-9]+');
Route::get('quote/comment/{comment_id}', array(
	'as' => 'quote_comment',
	'before' => 'Sentinel\auth',
	'uses' => 'CommentController@quoteComment'
))->where('comment_id', '[0-9]+');
Route::get('edit/comment/{comment_id}', array(
	'as' => 'retrieve_raw_comment_body',
	'before' => 'Sentinel\auth',
	'uses' => 'CommentController@retrieveRawBody'
))->where('comment_id', '[0-9]+');
Route::post('edit/comment/{comment_id}', array(
	'as' => 'retrieve_raw_comment_body',
	'before' => 'Sentinel\auth',
	'uses' => 'CommentController@editComment'
))->where('comment_id', '[0-9]+');

//voting
Route::get('vote/{thread_id}/up', array(
	'as' => 'vote_up',
	'before' => 'Sentinel\auth',
	'uses' => 'VoteController@voteUp'
))->where('thread_id', '[0-9]+');
Route::get('vote/{thread_id}/down', array(
	'as' => 'vote_down',
	'before' => 'Sentinel\auth',
	'uses' => 'VoteController@voteDown'
))->where('thread_id', '[0-9]+');

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
Route::get('account', array(
	'as' => 'account_view',
	'before' => 'Sentinel\auth',
	'uses' => function() {return View::make('account');}
));
Route::get('verification-sent', array('as' => 'verification-sent', function() {
	return View::make('verificationsent');
}));
