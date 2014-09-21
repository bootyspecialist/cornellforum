<?php

class HomeController extends BaseController {

	public function homePage() {
		$threads = Thread::orderBy('updated_at', 'desc')->paginate(5);
		return View::make('home', array('threads' => $threads));
	}

}
