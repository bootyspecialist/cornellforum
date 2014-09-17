<?php

class CommentController extends BaseController {

	public function newComment($thread_id) {
		$input = Input::only('body');
		$user = Sentry::getUser(); //logged in user
		if(!Thread::find($thread_id)) { //make sure thread exists
			return "You can't comment on a thread that doesn't exist.";
		}
		$validator = Validator::make(
			$input,
			array(
				'body' => array('required', 'min:25', 'max:2500')
			)
		);
		if ($validator->passes()) {
			$new_comment = Comment::create(array(
				'thread' => $thread_id
				'body_raw' => e($input['body']),
				'body' => BBCoder::convert(e($input['body'])), //apply BBCode to generate HTML and store it
				'user_id'=> $user->id
				//timestamps are automatically set to now()
			));
			return Redirect::to('thread/' . $new_thread->id . '/' . $new_thread->slug);
		} else {
			return Redirect::to('thread/new')->withInput()->withErrors($validator);
		}
	}

}
