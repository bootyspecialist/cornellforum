<?php

class Comment extends Eloquent {

	protected $fillable = array('body_raw', 'body', 'user_id', 'thread_id');

	public function thread() {
        return $this->hasOne('Thread');
    }

}
