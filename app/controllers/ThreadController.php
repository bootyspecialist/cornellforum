<?php

class ThreadController extends BaseController {

	public function viewThread($thread_id) {
		if (!$thread = Thread::find($thread_id)) {
			App::abort(404);
		}

		if (Sentry::check()) {
			//user is logged in, we should handle thread views
			$user = Sentry::getUser();
			if (View::where('user_id', '=', $user->id)->where('thread_id', '=', $thread->id)->exists()) { //check if view for this thread already exists
				//nope, create one
				$new_view = View::create(array(
					'user_id' => $user->id,
					'thread_id' => $thread->id,
					//timestamps automatically created
				));
			} else {
				//update the current one
				$view = View::where('user_id', '=', $user->id)->where('thread_id', '=', $thread->id)->first();
				$view->touch(); //will update timestamps
			}
		}

		$comments = Comment::where('thread_id', '=', $thread->id)->orderBy('created_at', 'asc')->get();
		return View::make('thread', array('thread' => $thread, 'comments' => $comments));
	}

	public function newThread() {
		$input = Input::only('title', 'body');
		$user = Sentry::getUser(); //logged in user
		$validator = Validator::make(
			$input,
			array(
				'title' => array('required', 'min:15', 'max:150'),
				'body' => array('required', 'min:25', 'max:2500')
			)
		);
		if ($validator->passes()) {
			$new_thread = Thread::create(array(
				'title' => e($input['title']),
				//slugs auto-generated with eloquent-sluggable
				'body_raw' => e($input['body']),
				'body' => BBCoder::convert(e($input['body'])), //apply BBCode to generate HTML and store it
				'user_id'=> $user->id
				//points defaults to 1 via schema
				//timestamps are automatically set to now()
			));
			return Redirect::to('thread/' . $new_thread->id . '/' . $new_thread->slug);
		} else {
			return Redirect::to('thread/new')->withInput()->withErrors($validator);
		}
	}

}
