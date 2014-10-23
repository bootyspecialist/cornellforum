<?php

class VoteController extends BaseController {

	public function voteUp($thread_id) {
		if(!$thread = Thread::find($thread_id)) { //make sure thread exists
			return "You can't vote on a thread that doesn't exist.";
		}

		$user = Sentry::getUser();
		if (Vote::where('user_id', '=', $user->id)->where('thread_id', '=', $thread->id)->exists()) {
			$old_vote = Vote::where('user_id', '=', $user->id)->where('thread_id', '=', $thread->id)->first();
			if ($old_vote->sign == 1) {
				//already upvoted
				return "You have already voted this thread up!";
			} else {
				//prevously downvoted, let's change it to an upvote
				$old_vote->sign = 1;
				$old_vote->save();
				$thread->points = $thread->points + 2; //add two to thread points (erase previous downvote)
				$thread->save();
				return Redirect::to('thread/' . $thread->id . '/' . $thread->slug); //don't use Redirect::back()
			}
		}

		//no existing vote, create one
		$new_vote = Vote::create(array(
			'user_id' => $user->id,
			'thread_id' => $thread->id,
			'sign' => 1
			//timestamps automatically created
		));

		$thread->timestamps = false;
		$thread->points = $thread->points + 1; //add one to thread points
		$thread->save();

		return Redirect::to('thread/' . $thread->id . '/' . $thread->slug); //don't use Redirect::back()
	}

	public function voteDown($thread_id) {
		if(!$thread = Thread::find($thread_id)) { //make sure thread exists
			return "You can't vote on a thread that doesn't exist.";
		}

		$user = Sentry::getUser();
		//can only do this if account at least 30 days old
		if (!$user->created_at->diff(\Carbon\Carbon::now())->days >= 30) {
			return 'Whoops! Your account must be at least 30 days old to downvote';
		}

		if (Vote::where('user_id', '=', $user->id)->where('thread_id', '=', $thread->id)->exists()) {
			$old_vote = Vote::where('user_id', '=', $user->id)->where('thread_id', '=', $thread->id)->first();
			if ($old_vote->sign == -1) {
				//already downvoted
				return "You have already voted this thread down!";
			} else {
				//prevously upvoted, let's change it to an downvote
				$old_vote->sign = -1;
				$old_vote->save();
				$thread->points = $thread->points - 2; //subtract two from thread points (erase previous upvote)
				$thread->save();
				return Redirect::to('thread/' . $thread->id . '/' . $thread->slug); //don't use Redirect::back()
			}
		}

		$new_vote = Vote::create(array(
			'user_id' => $user->id,
			'thread_id' => $thread->id,
			'sign' => -1
			//timestamps automatically created
		));

		$thread->timestamps = false;
		$thread->points = $thread->points - 1; //subtract one from thread points
		$thread->save();

		return Redirect::to('thread/' . $thread->id . '/' . $thread->slug); //don't use Redirect::back()

	}

}
