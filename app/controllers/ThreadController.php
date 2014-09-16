<?php

class ThreadController extends BaseController {

	public function viewThread($thread_id) {
		return 0;
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
    		//success! create new thread
		} else {
			//failure, return with errors
			return Redirect::to('thread/new')->withInput()->withErrors($validator);
		}
	}

}
