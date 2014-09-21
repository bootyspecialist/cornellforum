<?php

class ThreadController extends BaseController {

	public function viewThread($thread_id) {
		if (!$thread = Thread::find($thread_id)) {
			App::abort(404);
		}

		if (Sentry::check()) {
			//user is logged in, we should handle thread views
			$user = Sentry::getUser();
			if (Threadview::where('user_id', '=', $user->id)->where('thread_id', '=', $thread->id)->exists()) { //check if view for this thread already exists
				//update the current one
				$view = Threadview::where('user_id', '=', $user->id)->where('thread_id', '=', $thread->id)->first();
				$view->touch(); //will update timestamps
			} else {
				//nope, create a new one
				$new_view = Threadview::create(array(
					'user_id' => $user->id,
					'thread_id' => $thread->id,
					//timestamps automatically created
				));
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
				'title' => Wordfilter::filter(e($input['title'])),
				//slugs auto-generated with eloquent-sluggable
				'body_raw' => Wordfilter::filter(e($input['body'])),
				'body' => Wordfilter::filter(BBCoder::convert(e($input['body']))), //apply BBCode to generate HTML and store it
				'user_id'=> $user->id
				//points defaults to 1 via schema
				//timestamps are automatically set to now()
			));
			//also create a positive vote from the user
			$new_vote = Vote::create(array(
				'user_id' => $user->id,
				'thread_id' => $new_thread->id,
				'sign' => 1
				//timestamps automatically created
			));
			//but don't increment the thread's points because they already default to 1
			return Redirect::to('thread/' . $new_thread->id . '/' . $new_thread->slug);
		} else {
			return Redirect::to('thread/new')->withInput()->withErrors($validator);
		}
	}

	public function deleteThread($thread_id) {
		if (!$thread = Thread::find($thread_id)) {
			//thread doesn't exist
			return Redirect::to('/');
		}

		if (Sentry::getUser()->id != $thread->user_id) {
			//don't have permission to delete thread
			return Redirect::to('/');
		}

		$thread->comments()->delete();
		$thread->votes()->delete();
		$thread->threadviews()->delete();
		$thread->delete();
		return Redirect::to('/');
	}

}
