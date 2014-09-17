<?php

use Cartalyst\Sentry\Users\Eloquent\User as SentryUserModel;

class User extends SentryUserModel {

    public function canDownVote() {
		return $this->created_at->diff(Carbon::now())->days >= 0;
	}

}
