<?php

class Comment extends Eloquent {

	protected $fillable = array('body_raw', 'body', 'user_id', 'thread_id');
	// protected $touches = array('Thread'); //disabled this because needed to add no bump functionality and didn't know how to override

	public function thread() {
        return $this->belongsTo('Thread');
    }

}
