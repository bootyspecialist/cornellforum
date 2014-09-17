<?php

class VoteController extends BaseController {

	public function upVote($thread_id) {

	}

	public function downVote($thread_id) {
		//can only do this if account at least 30 days old
		if (Sentry::getUser()->created_at->diff(\Carbon\Carbon::now())->days >= 30) {

		} else {
			return 'Whoops! Your account must be at least 30 days old to downvote';
		}
	}

}
