<?php

class HomeController extends BaseController {

	public function homePage() {
		$threads = Thread::orderBy('updated_at', 'desc')->take(25)->get();
		return View::make('home', array('threads' => $threads));
	}

}
