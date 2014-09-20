<?php

class VoteController extends BaseController {

	public function voteUp($thread_id) {
		if(!$thread = Thread::find($thread_id)) { //make sure thread exists
			return "You can't vote on a thread that doesn't exist.";
		}

		$user = Sentry::getUser();
		if (Vote::where('user_id', '=', $user->id)->where('thread_id', '=', $thread->id)->exists()) {
			return "You have already voted on this thread!";
		}

		$new_vote = Vote::create(array(
			'user_id' => $user->id,
			'thread_id' => $thread->id,
			'sign' => 1
			//timestamps automatically created
		));

		$thread->timestamps = false;
		$thread->score = $thread->score + 1; //add one to thread score
		$thread->save();

		return Redirect::to('thread/' . $thread->id . '/' . $thread->slug); //don't use Redirect::back()
	}

	public function voteDown($thread_id) {
		$user = Sentry::getUser();
		//can only do this if account at least 30 days old
		if (!$user->created_at->diff(\Carbon\Carbon::now())->days >= 30) {
			return 'Whoops! Your account must be at least 30 days old to downvote';
		}

		if (Vote::where('user_id', '=', $user->id)->where('thread_id', '=', $thread->id)->exists()) {
			return "You have already voted on this thread!";
		}

		$new_vote = Vote::create(array(
			'user_id' => $user->id,
			'thread_id' => $thread->id,
			'sign' => -1
			//timestamps automatically created
		));

		$thread->timestamps = false;
		$thread->score = $thread->score - 1; //subtract one from thread score
		$thread->save();

		return Redirect::to('thread/' . $thread->id . '/' . $thread->slug); //don't use Redirect::back()

	}

}
