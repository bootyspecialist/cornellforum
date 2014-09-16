<?php

class ThreadController extends BaseController {

	public function viewThread($thread_id) {
		if ($thread = Thread::find($thread_id)) {
			return View::make('thread', array('thread' => $thread));
		} else {
			App::abort(404);
		}
		$thread = Thread::find()
		return view;
	}

	public function newThread() {
		$input = Input::only('title', 'body');
		$user = Sentry::getUser();
		$validator = Validator::make(
			$input,
			array(
				'title' => array('required', 'between:15,150'),
				'body' => array('required', 'between:25, 2500')
			)
		);

		if ($validator->passes()) {
		} else {
			return Redirect::to('thread/new')->withInput()->withErrors($validator);
		}
	}

}
