<?php

class CommentController extends BaseController {

	public function newComment($thread_id) {
		$input = Input::only('body', 'no_bump');
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
			if($input['no_bump'] != 'yes') {
				$thread->touch();
			}
			$new_comment = Comment::create(array(
				'body_raw' => Wordfilter::filter(e($input['body'])),
				'body' => Wordfilter::filter(BBCoder::convert(e($input['body']))), //apply BBCode to generate HTML and store it
				'user_id' => $user->id,
				'thread_id' => $thread->id
				//timestamps are automatically set to now()
			));
			return Redirect::to('thread/' . $thread->id . '/' . $thread->slug . '#comment-' . $new_comment->id); //don't use Redirect::back()
		} else {
			return Redirect::to('thread/' . $thread->id . '/' . $thread->slug . '#new-comment-form')->withInput()->withErrors($validator);
		}
	}

	public function editCommentForm($comment_id) {
		if (!$comment = Comment::find($comment_id)) {
			//comment doesn't exist
			return;
		}
		return View::make('editcommentform', array('comment' => $comment));
	}

	public function editComment($comment_id) {
		$input = Input::only('body');
		$user = Sentry::getUser();
		if (!$comment = Comment::find($comment_id)) {
			//comment doesn't exist
			return Redirect::to('/');
		}
		if(!$thread = $comment->thread) { //make sure thread exists
			return "You can't comment on a thread that doesn't exist.";
		}
		$validator = Validator::make(
			$input,
			array(
				'body' => array('required', 'min:5', 'max:2500')
			)
		);
		if ($validator->passes()) {
			$comment->body_raw = Wordfilter::filter(e($input['body']));
			$comment->body = Wordfilter::filter(BBCoder::convert(e($input['body']))); //apply BBCode to generate HTML and store it
			$comment->save();
			return Redirect::to('thread/' . $thread->id . '/' . $thread->slug . '#comment-' . $comment->id); //don't use Redirect::back()
		} else {
			//fix this
			return Redirect::to('thread/' . $thread->id . '/' . $thread->slug . '#comment-' . $comment->id)->withInput()->withErrors($validator);
		}
	}

	public function quoteComment($comment_id) {
		if (!$comment = Comment::find($comment_id)) {
			//comment doesn't exist
			return Redirect::to('/');
		}
		$quote = trim(preg_replace('/\s+/', ' ', $comment->body_raw));
		$quote = preg_replace('/\[quote\](.*?)\[\/quote\]/is', '', $quote);
		$quote = preg_replace('/\[img\](.*?)\[\/img\]/is', "$1\r\n\r\n", $quote);
		return Response::json(array('quote' => '[quote]' . $quote . "[/quote]\r\n\r\n"));
	}

	public function deleteComment($comment_id) {
		if (!$comment = Comment::find($comment_id)) {
			//comment doesn't exist
			return Redirect::to('/');
		}
		if (Sentry::getUser()->id != $comment->user_id) {
			//don't have permission to delete thread
			return Redirect::to('/');
		}
		$thread = Thread::find($comment->thread_id); //not sure why $comment->thread() doesn't work here?
		$comment->delete();
		return Redirect::to('thread/' . $thread->id . '/' . $thread->slug); //don't use Redirect::back()
	}

}
