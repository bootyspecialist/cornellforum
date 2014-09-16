@extends('layouts.master')
@section('title')
	Thread {{ $thread->id }} - {{ $thread->title }}
@stop
@section('content')
	<div class="col-md-12">
		<div id="thread-intro">
			<h3 class="thread-title">{{ $thread->title }}</h3>
			<h4 class="thread-subtitle">{{ $thread->points }} points, x comments, posted {{ $thread->created_at }}</h4>
			<p class="thread-body">{{ $thread->body }}</p>
			<a href="/"><i class="fa fa-angle-double-left"></i> Back to homepage</a>
		</div>
		<div id="comments">
			<h5 class="comments-header">Comments:</h5>
		</div>
		<div id="reply-area">
			<h5 class="comments-header pull-left">Comment on this thread:</h5>
			<a class="posting-tips pull-right" target="_blank" href="/frequently-asked-questions">want some posting tips?</a>
			@if(Sentry::check())
				<div id="new-comment-form">
					<form action="/comment/{{ thread->id }}/new/" method="post" role="form">
					</form>
				</div>
			@else
				<div id="new-comment-form">
					<form role="form">
						<textarea class="textarea form-control" cols="40" id="id_body" name="body" placeholder="Whoops! You need to log in or create an account to do this..." disabled rows="4"></textarea>
					</form>
				</div>
				<p class="need-to-login"><a class="btn btn-primary" href="/account/login"><i class="fa fa-sign-in"></i> Login</a> or <a class="btn btn-primary" href="/account/signup"><i class="fa fa-user"></i> create an account</a> to post a comment on this thread. Creating an account is quick and easy, we promise! <i class="fa fa-smile-o"></i></p>
			@endif
		</div>
	</div>
@stop
