<?php

class Thread extends Eloquent {

	protected $fillable = array('title', 'body_raw', 'body', 'user_id');

}