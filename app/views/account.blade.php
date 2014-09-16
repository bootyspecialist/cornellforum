@extends('layouts.master')
@section('title')
	Account
@stop
@section('content')
	<div class="col-md-12">
		<h4 class="spacer">Account information:</h4>
		<p><i class="fa fa-check-square"></i> <strong>{{ Sentry::getUser()->email }}</strong></p>
		<ul class="list-unstyled">
			<li>Your email is verified and you can post/comment as much as you like.</li>
			<li>This information will <u>never</u> be shown next to threads or posts you make.</li>
		</ul>
		<a class="btn btn-default" href="/">Return to homepage</a>
	</div>
@stop
