<?php

class View extends Eloquent {

	protected $fillable = array('user_id', 'thread_id');

    public function thread() {
        return $this->belongsTo('Thread');
    }

}
