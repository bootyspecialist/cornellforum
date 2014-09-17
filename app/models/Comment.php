<?php

class Comment extends Eloquent {

	protected $fillable = array('body_raw', 'body', 'user_id', 'thread_id');
	protected $touches = array('Thread');

	public function thread() {
        return $this->belongsTo('Thread');
    }

}
