<?php

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Thread extends Eloquent implements SluggableInterface {

	use SluggableTrait;

	protected $fillable = array('title', 'body_raw', 'body', 'user_id');
	protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );


}
