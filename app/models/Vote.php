<?php

class Vote extends Eloquent {

    public function thread() {
        return $this->belongsTo('Thread');
    }

}
