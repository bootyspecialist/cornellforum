<?php

class Vote extends Eloquent {

	protected $fillable = array('user_id', 'thread_id', 'sign');

    public function thread() {
        return $this->belongsTo('Thread');
    }

}
