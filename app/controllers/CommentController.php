<?php

class CommentController extends BaseController {

	public function newComment($thread_id) {
		$input = Input::only('body');
		$user = Sentry::getUser(); //logged in user
		if(!$thread = Thread::find($thread_id)) { //make sure thread exists
			return "You can't comment on a thread that doesn't exist.";
		}
		$validator = Validator::make(
			$input,
			array(
				'body' => array('required', 'min:5', 'max:2500')
			)
		);
		if ($validator->passes()) {
			$new_comment = Comment::create(array(
				'body_raw' => e($input['body']),
				'body' => BBCoder::convert(e($input['body'])), //apply BBCode to generate HTML and store it
				'user_id' => $user->id,
				'thread_id' => $thread->id
				//timestamps are automatically set to now()
			));
			return Redirect::to('thread/' . $thread->id . '/' . $thread->slug . '#comment-' . $new_comment->id); //don't use Redirect::back()
		} else {
			return Redirect::to('thread/' . $thread->id . '/' . $thread->slug . '#new-comment-form')->withInput()->withErrors($validator);
		}
	}

}
